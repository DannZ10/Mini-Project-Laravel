<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Runs on every deploy: leave an already-seeded database alone.
        if (User::exists()) {
            return;
        }

        // 1. Seed Users (Student, Instructors, Admin)
        $admin = User::create([
            'name' => 'Admin DibiEdu',
            'email' => 'admin@dibiedu.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $student = User::create([
            'name' => 'John Doe',
            'email' => 'student@dibiedu.com',
            'password' => Hash::make('password'),
            'role' => 'student'
        ]);

        $instructor1 = User::create([
            'name' => 'Elena Rodriguez',
            'email' => 'elena@dibiedu.com',
            'password' => Hash::make('password'),
            'role' => 'instructor'
        ]);

        $instructor2 = User::create([
            'name' => 'Marcus Chen',
            'email' => 'marcus@dibiedu.com',
            'password' => Hash::make('password'),
            'role' => 'instructor'
        ]);

        $instructor3 = User::create([
            'name' => 'Dr. Sarah Jenkins',
            'email' => 'sarah@dibiedu.com',
            'password' => Hash::make('password'),
            'role' => 'instructor'
        ]);

        $instructor4 = User::create([
            'name' => 'David Park',
            'email' => 'david@dibiedu.com',
            'password' => Hash::make('password'),
            'role' => 'instructor'
        ]);

        // 2. Seed Categories
        $catWebDev = CourseCategory::create([
            'name' => 'Web Dev',
            'description' => 'Web Development Courses',
            'icon' => 'code'
        ]);

        $catDesign = CourseCategory::create([
            'name' => 'Design',
            'description' => 'UI/UX and Graphic Design Courses',
            'icon' => 'devices'
        ]);

        $catDataScience = CourseCategory::create([
            'name' => 'Data Science',
            'description' => 'Data Analysis and Machine Learning Courses',
            'icon' => 'bar_chart'
        ]);

        $catMarketing = CourseCategory::create([
            'name' => 'Marketing',
            'description' => 'Digital Marketing and Growth Hacking Courses',
            'icon' => 'trending_up'
        ]);

        // 3. Seed Courses
        Course::create([
            'instructor_id' => $instructor1->id,
            'category_id' => $catWebDev->id,
            'title' => 'Advanced Frontend Architecture',
            'description' => 'Master scalable modern web applications with React, Next.js, and advanced state management patterns.',
            'price' => 129000,
            'quota' => 50,
            'rating' => 9.2, // Will map to "Top Rated"
            'thumbnail' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAc8iJY_AGicOyhWFU-ZkA1tPedSGn7vmVEmmztm3Q6OCSNcgrQL8nKipO-yFg840AWB9UMU7a0db5UtZHrLtkWA4f-vz0gi73moXQgC1z1_viysrDqLtIluSf-q9ec-sqr3VqvY4BQFp5SFUEbL4S1t4MnLYeSairE3BNNVXdPjSaOpyBBBVaCe04O0wfbZvUqH4rrMOB6i6EHx2uGoe0IYpBAL4nxJZyQDk0A9blWLfKyjUn7NowS',
            'level' => 'intermediate',
            'duration' => 40,
            'status' => 'published',
            'enrolled_count' => 1200
        ]);

        Course::create([
            'instructor_id' => $instructor2->id,
            'category_id' => $catDesign->id,
            'title' => 'UI/UX Masterclass: From Zero to Hero',
            'description' => 'Learn user research, wireframing, prototyping, and creating stunning interfaces in Figma.',
            'price' => 149000,
            'quota' => 100,
            'rating' => 8.8, // Will map to "Top Rated"
            'thumbnail' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBCWnasujQpehrX47S9_ZpW3Rwknhrp4WGjFZkMwR-G8gKXA1BM_fIH0mMbRtzYv5b5nRev3PthPA4gSZ4xLgt5Zzj2Oh28BoUcj_ksyGbLj6pCZNL1B3r5Mc3O8fgC9wn4MjtNURflxQGWuJF5nH9MZv5cIlryE1XWBfCGCOWgz1igfGdW4FvdDDobKzLlg8Cg1QHuz6Aqk8OI68H6bRsziWf_oU2XtHUxJrXJcKd-FyF8krC3bBN2',
            'level' => 'beginner',
            'duration' => 30,
            'status' => 'published',
            'enrolled_count' => 845
        ]);

        Course::create([
            'instructor_id' => $instructor3->id,
            'category_id' => $catDataScience->id,
            'title' => 'Python for Machine Learning',
            'description' => 'Build real-world AI models. A comprehensive guide to NumPy, Pandas, Scikit-Learn, and deep learning basics.',
            'price' => 189000,
            'quota' => 30,
            'rating' => 9.5, // Will map to "Top Rated"
            'thumbnail' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvOkGgqPhLt1On-KcSVhrIV-Lyp3nLbcukA_V_G3teMlUuFuX_zEMyhtVtxVHZPP1XyCJjIrA9TD-WbbQ4T4guqJSbnWDYWDBMBS0x3LkccMPVmiCq-BXxHbCbh3HJqRLfakdT5paB_xYuJjr2JIq6UGSB7fJuG05LXznnUN3OPNvq0j6ZnZqFP8XWKiHsBlnGIsFT_HNrEaz5vAcPycm7mfxcB9riqa9R5IbXfPlU3OMffsccsau1',
            'level' => 'advanced',
            'duration' => 60,
            'status' => 'published',
            'enrolled_count' => 2100
        ]);

        Course::create([
            'instructor_id' => $instructor4->id,
            'category_id' => $catMarketing->id,
            'title' => 'Growth Hacking & Digital Strategy',
            'description' => 'Learn proven frameworks to scale businesses rapidly using SEO, paid acquisition, and viral loops.',
            'price' => 99000,
            'quota' => 200,
            'rating' => 8.2, // Will map to "Recommended"
            'thumbnail' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBsM32Ab7LX7GRpG-44KEUhcpIiWKBHIHsxQmOfMWqthCK6Rm4wPCmgcaD5yXXw1X03-ED6cTo41nGXcLogjDR33Il30sBT_9nP0Hp59x0feiLWpvOuiHwsYT5x78Be6fHyRZoKXjccM7jKztO4al7J-N5ss46r1tvHG5sHCRXmDxTXJf-dbj8UmonRVNHCiVmTbaBLdDI3NJNw7LetaNS2HNUMwSvv9qAkKY9yM2gy32a7yTOAUb3H',
            'level' => 'beginner',
            'duration' => 25,
            'status' => 'published',
            'enrolled_count' => 532
        ]);
    }
}
