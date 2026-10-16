<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Course;

class FixDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $map = [
            'Induksi Keselamatan Kerja (K3) - Level 1' => 'Health, Safety & Environment',
            'SOP Operasional Mesin Slitting' => 'Production',
            'Proses Pembuatan Pipa Baja (ERW & SAW)' => 'Production',
            'Standar Quality Control Pipa API 5L' => 'Quality Control',
            'SPINDO Corporate Values (AKHLAK)' => 'Human Resources',
            'Work Habbits (Sikap Kerja)' => 'Human Resources',
            'Team Leadership' => 'Manajemen & Leadership',
            'Production Planning' => 'Manajemen & Leadership',
            'Continuous Improvement' => 'Manajemen & Leadership',
        ];

        foreach ($map as $courseTitle => $deptName) {
            $department = Department::where('name', $deptName)->first();
            
            if (!$department) {
                // Determine code if creating new
                $code = strtoupper(substr($deptName, 0, 3));
                if ($deptName === 'Production') $code = 'PRO';
                if ($deptName === 'Human Resources') $code = 'HRD';
                if ($deptName === 'Health, Safety & Environment') $code = 'HSE';
                if ($deptName === 'Quality Control') $code = 'QA';
                
                $department = Department::create([
                    'name' => $deptName,
                    'code' => $code
                ]);
            }

            $course = Course::where('title', $courseTitle)->first();
            
            if ($course) {
                $course->update(['department_id' => $department->id]);
                $this->command->info("Updated {$course->title} -> {$department->name}");
            } else {
                $this->command->warn("Course not found: {$courseTitle}");
            }
        }
    }
}
