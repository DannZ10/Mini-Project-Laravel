<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = CourseCategory::all();
        return $this->successResponse($categories, 'Data kategori kursus berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:course_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $category = CourseCategory::create($request->all());
        return $this->successResponse($category, 'Kategori kursus berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $category = CourseCategory::with('courses')->find($id);

        if (!$category) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        return $this->successResponse($category, 'Detail kategori beserta daftar kursusnya berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        $category = CourseCategory::findOrFail($id);

        if (!$category) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:course_categories,name,' . $id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $category->update($request->all());
        return $this->successResponse($category, 'Kategori kursus berhasil diupdate');
    }

    public function destroy($id)
    {
        $category = CourseCategory::findOrFail($id);

        if (!$category) {
            return $this->errorResponse('Data tidak ditemukan', null, 404);
        }

        if ($category->courses()->count() > 0) {
            return $this->errorResponse('Kategori tidak bisa dihapus karena memiliki kursus terkait', null, 400);
        }

        $category->delete();
        return $this->successResponse(null, 'Kategori kursus berhasil dihapus');
    }
}
