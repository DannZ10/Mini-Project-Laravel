<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $cacheKey = 'courses_' . md5(json_encode($request->all()));

        $courses = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Course::with(['category', 'instructor']);

            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->search . '%');
            }

            if ($request->has('category_id')) {
                $query->where('category_id', $request->input('category_id'));
            }

            if ($request->has('sort_by') && $request->has('order')) {
                $query->orderBy($request->input('sort_by'), $request->input('order'));
            }

            return $query->get();
        });

        foreach ($courses as $course) {
            $course->rating_class = $course->rating_class;
        }

        return $this->successResponse($courses, 'Daftar kursus berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:course_categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $data = $request->all();
        $data['instructor_id'] = Auth::user()->id;

        $course = Course::create($data);
        return $this->successResponse($course, 'Kursus berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $course = Course::with(['category', 'instructor'])->find($id);

        if (!$course) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $course->rating_class = $course->rating_class;
        return $this->successResponse($course, 'Detail kursus berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        $course = Course::with(['category', 'instructor'])->find($id);

        if (!$course) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'quota' => 'sometimes|required|integer|min:0',
            'rating' => 'sometimes|required|numeric|min:0|max:10',
            'category_id' => 'sometimes|required|exists:course_categories,id',
            'level' => 'sometimes|required|in:beginner,intermediate,advanced',
            'duration' => 'sometimes|required|integer|min:1',
            'status' => 'in:draft,published',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $course->update($request->all());
        return $this->successResponse($course, 'Kursus berhasil diupdate');
    }

    public function destroy($id)
    {
        $course = Course::with(['category', 'instructor'])->find($id);

        if (!$course) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        if ($course->instructor_id() != Auth::user()->id && Auth::user()->role() != 'admin') {
            return $this->errorResponse('Anda tidak memiliki izin untuk menghapus kursus ini', null, 403);
        }

        $course->forceDelete();
        return $this->successResponse(null, 'Kursus berhasil dihapus');
    }

    public function stats()
    {
        $stats = DB::table('course_categories')
            ->leftJoin('courses', 'course_categories.id', '=', 'courses.category_id')
            ->select(
                'course_categories.name as category_name',
                DB::raw('COUNT(courses.id) as total_course'),
                DB::raw('ROUND(AVG(courses.price), 0) as average_price')
            )
            ->groupBy('course_categories.name')
            ->get();

        return $this->successResponse($stats, 'Statistik kursus berhasil diambil');
    }
}
