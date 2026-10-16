<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;

class PpicCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure PPIC Department exists
        $department = Department::firstOrCreate(
            ['code' => 'PPIC'],
            ['name' => 'Production Planning & Inventory Control']
        );
        
        $this->command->info("Department ensured: {$department->name} ({$department->code})");

        // 2. Define PPIC Courses
        $courses = [
            [
                'title' => 'Dasar Management Supply Chain',
                'description' => 'Memahami konsep dasar rantai pasok dari hulu ke hilir dan pentingnya integrasi antar departemen.',
            ],
            [
                'title' => 'Master Production Schedule (MPS)',
                'description' => 'Teknik pembuatan jadwal produksi induk untuk menyeimbangkan permintaan dan kapasitas produksi.',
            ],
            [
                'title' => 'Material Requirement Planning (MRP)',
                'description' => 'Perencanaan kebutuhan material yang efektif untuk menjamin ketersediaan bahan baku tanpa overstock.',
            ],
            [
                'title' => 'Inventory Control & Warehouse Management',
                'description' => 'Strategi pengendalian stok, level safety stock, dan manajemen tata kelola gudang yang efisien.',
            ],
            [
                'title' => 'Forecasting Permintaan',
                'description' => 'Metode peramalan permintaan pasar menggunakan data historis dan tren untuk perencanaan produksi.',
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::firstOrCreate(
                ['title' => $courseData['title']],
                [
                    'department_id' => $department->id,
                    'description' => $courseData['description'],
                    'is_published' => true,
                    'thumbnail' => null,
                ]
            );
            
            if ($course->wasRecentlyCreated) {
                $this->command->info("Created course: {$course->title}");
                
                // Create Introduction Lesson
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => 'Pengantar ' . $course->title,
                    'content_body' => "Selamat datang di kursus {$course->title}. Modul ini akan membahas dasar-dasar dan aplikasi praktis...",
                    'content_type' => 'text',
                    'sort_order' => 1,
                ]);

                // Create Pre-Test and Post-Test
                $this->createQuiz($course, 'Pre-Test');
                $this->createQuiz($course, 'Post-Test');
            } else {
                $this->command->info("Skipped existing course: {$course->title}");
            }
        }
    }

    private function createQuiz(Course $course, $type)
    {
        $quiz = Quiz::create([
            'course_id' => $course->id,
            'title' => "{$type}: {$course->title}",
            'description' => "Evaluasi pemahaman materi {$course->title}.",
            'passing_percentage' => 70,
        ]);

        // Add 5 Random Questions related to PPIC (Generic pool for prototype)
        $questions = [
            [
                'question' => 'Apa tujuan utama dari PPIC?',
                'options' => ['Menjembatani Sales dan Produksi', 'Meningkatkan penjualan', 'Merekrut karyawan', 'Memperbaiki mesin'],
                'correct' => 'Menjembatani Sales dan Produksi',
            ],
            [
                'question' => 'Apa itu Safety Stock?',
                'options' => ['Stok pengaman untuk variabilitas supply/demand', 'Stok yang rusak', 'Stok untuk dijual murah', 'Stok tanpa dokumen'],
                'correct' => 'Stok pengaman untuk variabilitas supply/demand',
            ],
            [
                'question' => 'Dalam MRP, apa input utama yang diperlukan?',
                'options' => ['BOM, Inventory, MPS', 'Mesin, Orang, Uang', 'Sales Order, Invoice', 'Surat Jalan'],
                'correct' => 'BOM, Inventory, MPS',
            ],
            [
                'question' => 'Manakah yang termasuk biaya inventory?',
                'options' => ['Holding cost', 'Marketing cost', 'R&D cost', 'Legal cost'],
                'correct' => 'Holding cost',
            ],
            [
                'question' => 'Apa kepanjangan dari BOM?',
                'options' => ['Bill of Materials', 'Bill of Money', 'Base of Manufacture', 'Build of Model'],
                'correct' => 'Bill of Materials',
            ],
        ];

        foreach ($questions as $index => $q) {
            Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $q['question'],
                'sort_order' => $index + 1,
                'question_type' => 'multiple_choice',
                'options' => $q['options'],
                'correct_answer' => $q['correct'],
            ]);
        }
    }
}
