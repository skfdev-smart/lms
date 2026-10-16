<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Lesson;

class DetailedCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Manajemen & Leadership' => [
                'Team Leadership',
                'Production Planning',
                'Continuous Improvement',
                'Problem Solving',
                'Project Management',
                'Cost Control',
            ],
            'Safety & Environment' => [
                'K3 Umum',
                'First Aid',
                'Fire Fighting',
                'LOTO (Lockout Tagout)',
                'Confined Space',
                'Waste Management',
            ],
            'Produksi & Manufaktur' => [
                'Operasi Mesin Slitting',
                'Operasi Mesin Forming',
                'Operasi Mesin Welding ERW',
                'Operasi Mesin Sizing',
                'Operasi Mesin Cut-Off',
                'Setting Tooling',
                'Galvanizing Process',
            ],
            'Quality Control' => [
                'Pengukuran Dimensi',
                'Visual Inspection',
                'NDT - Ultrasonic Testing',
                'NDT - Eddy Current',
                'Hydrostatic Testing',
                'Tensile Testing',
                'Chemical Analysis',
                'Standar SNI/JIS/ASTM',
            ],
            'Maintenance & Engineering' => [
                'Preventive Maintenance',
                'Troubleshooting Mekanik',
                'Troubleshooting Elektrik',
                'PLC Programming',
                'Welding Maintenance',
                'Hydraulic System',
                'Pneumatic System',
            ],
            'IT & Digital' => [
                'Microsoft Office',
                'ERP/SAP',
                'Data Analysis',
                'AutoCAD',
                'MES System',
            ],
        ];

        foreach ($data as $categoryName => $courses) {
            // Create Department
            $code = strtoupper(substr($categoryName, 0, 3));
            $existing = Department::where('code', $code)->first();
            
            if ($existing) {
                if ($existing->name !== $categoryName) {
                    $code = strtoupper(substr($categoryName, 0, 2) . substr($categoryName, -1)); 
                }
            }

            $department = Department::firstOrCreate(
                ['name' => $categoryName],
                ['code' => $code]
            );

            foreach ($courses as $courseTitle) {
                try {
                    // Check if course exists
                    $course = Course::where('title', $courseTitle)->first();

                    if (!$course) {
                        $course = Course::create([
                            'title' => $courseTitle,
                            'department_id' => $department->id,
                            'description' => "Comprehensive training on {$courseTitle}. This course covers all the essential aspects and practical applications relevant to the {$categoryName} field.",
                            'is_published' => true,
                            'thumbnail' => null, 
                        ]);

                        $this->command->info("Created course: {$courseTitle}");

                        // Create Introduction Lesson
                        Lesson::create([
                            'course_id' => $course->id,
                            'title' => 'Introduction to ' . $courseTitle,
                            'content_body' => "Welcome to the {$courseTitle} course. In this lesson, we will explore the fundamentals...",
                            'content_type' => 'text',
                            'sort_order' => 1,
                        ]);
                    } else {
                         $this->command->info("Skipped existing course: {$courseTitle}");
                    }

                    // Create Quizzes (If they don't exist logic is simple: we usually append. But here we want to ensure 2 quizzes)
                    // We'll add 'Pre-Test' and 'Post-Test' if they don't exist
                    
                    $this->createQuizWithType($course, 'Pre-Test', $categoryName);
                    $this->createQuizWithType($course, 'Post-Test', $categoryName);

                } catch (\Exception $e) {
                    $this->command->error("Failed to create data for {$courseTitle}. Error: " . $e->getMessage());
                }
            }
        }
    }

    private function createQuizWithType(Course $course, $type, $categoryName)
    {
        $quizTitle = "{$type}: {$course->title}";
        $existingQuiz = Quiz::where('course_id', $course->id)->where('title', $quizTitle)->first();

        if ($existingQuiz) {
             return;
        }

        $quiz = Quiz::create([
            'course_id' => $course->id,
            'title' => $quizTitle,
            'description' => "{$type} assessment for {$course->title}.",
            'passing_percentage' => 70,
        ]);

        $questions = $this->getQuestionsForCategory($categoryName, $type);
        
        $sortOrder = 1;
        foreach ($questions as $q) {
            try {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => $q['question'],
                    'sort_order' => $sortOrder++,
                    'question_type' => 'multiple_choice', 
                    'options' => $q['options'],
                    'correct_answer' => $q['correct'],
                ]);
            } catch (\Exception $e) {
                $this->command->error("Failed to create question: " . $e->getMessage());
            }
        }
        
         $this->command->info("Created quiz: {$quizTitle}");
    }

    private function getQuestionsForCategory($category, $type)
    {
        // Pool of questions. We will return 5 relevant ones.
        // Simplified sets for brevity but relevant context.
        
        switch ($category) {
            case 'Manajemen & Leadership':
                return [
                    [
                        'question' => 'What is the most effective leadership style for a crisis?',
                        'options' => ['Democratic', 'Laissez-faire', 'Autocratic', 'Transformational'],
                        'correct' => 'Autocratic',
                    ],
                    [
                        'question' => 'What does KPI stand for?',
                        'options' => ['Key Performance Indicator', 'Key Process Index', 'Keep People Informed', 'Key Product Innovation'],
                        'correct' => 'Key Performance Indicator',
                    ],
                    [
                        'question' => 'What is the PDCA cycle?',
                        'options' => ['Plan-Do-Check-Act', 'Process-Design-Check-Approve', 'Plan-Done-Checked-Action', 'Prepare-Define-Control-Audit'],
                        'correct' => 'Plan-Do-Check-Act',
                    ],
                    [
                        'question' => 'Smart goals should be...',
                        'options' => ['Specific, Measurable, Achievable, Relevant, Time-bound', 'Simple, Measurable, Actionable, Relevant, Timely', 'Specific, Major, Achievable, Real, Time-based', 'Strategic, Motivating, Action, Result, Time'],
                        'correct' => 'Specific, Measurable, Achievable, Relevant, Time-bound',
                    ],
                    [
                        'question' => 'Which is NOT a function of management?',
                        'options' => ['Planning', 'Organizing', 'Gossiping', 'Controlling'],
                        'correct' => 'Gossiping',
                    ],
                ];
            case 'Safety & Environment':
               return [
                    [
                        'question' => 'What is the first priority in K3?',
                        'options' => ['Productivity', 'Safety of workers', 'Cost reduction', 'Speed'],
                        'correct' => 'Safety of workers',
                    ],
                    [
                        'question' => 'What does PPE stand for?',
                        'options' => ['Personal Protective Equipment', 'Public Protective Equipment', 'Proper Process Environment', 'Personal Process Equipment'],
                        'correct' => 'Personal Protective Equipment',
                    ],
                    [
                        'question' => 'Which class of fire involves flammable liquids?',
                        'options' => ['Class A', 'Class B', 'Class C', 'Class D'],
                        'correct' => 'Class B',
                    ],
                    [
                        'question' => 'What is the purpose of LOTO?',
                        'options' => ['To lock doors', 'To prevent accidental machine startup', 'To tag products', 'To organizing tools'],
                        'correct' => 'To prevent accidental machine startup',
                    ],
                    [
                        'question' => 'ISO 14001 focuses on...',
                        'options' => ['Envronmental Management', 'Quality Management', 'Safety Management', 'Information Security'],
                        'correct' => 'Envronmental Management',
                    ],
                ];
            case 'Produksi & Manufaktur':
               return [
                    [
                        'question' => 'What is OEE?',
                        'options' => ['Overall Equipment Effectiveness', 'Overall Energy Efficiency', 'Operational Equipment Efficiency', 'Operational Energy Effectiveness'],
                        'correct' => 'Overall Equipment Effectiveness',
                    ],
                    [
                        'question' => 'Which is a 5S component?',
                        'options' => ['Seiri (Sort)', 'Speed', 'Secure', 'Sales'],
                        'correct' => 'Seiri (Sort)',
                    ],
                    [
                        'question' => 'What is "Just-In-Time" production?',
                        'options' => ['Producing only what is needed, when needed', 'Producing as much as possible', 'Producing when workers are ready', 'Producing based on last year forecast'],
                        'correct' => 'Producing only what is needed, when needed',
                    ],
                    [
                        'question' => 'A bottleneck in production is...',
                        'options' => ['The slowest point in the process', 'The fastest point', 'The packaging area', 'The raw material store'],
                        'correct' => 'The slowest point in the process',
                    ],
                    [
                        'question' => 'What is Kaizen?',
                        'options' => ['Continuous Improvement', 'Process Shutdown', 'Quality Audit', 'New Machine Installation'],
                        'correct' => 'Continuous Improvement',
                    ],
                ];
             case 'Quality Control':
               return [
                    [
                         'question' => 'What is the main goal of QC?',
                         'options' => ['To ensure product meets requirements', 'To speed up production', 'To reduce staff', 'To increase price'],
                         'correct' => 'To ensure product meets requirements',
                    ],
                    [
                         'question' => 'What is NDT?',
                         'options' => ['Non-Destructive Testing', 'New Design Technology', 'Normal Dimension Tolerance', 'Non-Digital Tool'],
                         'correct' => 'Non-Destructive Testing',
                    ],
                    [
                         'question' => 'ISO 9001 is a standard for...',
                         'options' => ['Quality Management Systems', 'Environmental Management', 'Information Security', 'Safety Management'],
                         'correct' => 'Quality Management Systems',
                    ],
                    [
                         'question' => 'What is a "visual inspection"?',
                         'options' => ['Checking defects with eyes', 'Using X-ray', 'Listening to noise', 'Chemical testing'],
                         'correct' => 'Checking defects with eyes',
                    ],
                    [
                         'question' => 'Tolerance in engineering means...',
                         'options' => ['The allowable variation in a dimension', 'Being patient with workers', 'The strength of material', 'The weight of product'],
                         'correct' => 'The allowable variation in a dimension',
                    ],
               ];
             case 'Maintenance & Engineering':
               return [
                    [
                         'question' => 'What is Preventive Maintenance?',
                         'options' => ['Maintenance done to prevent failure', 'Fixing only after breakdown', 'Replacing new machines', 'Cleaning only'],
                         'correct' => 'Maintenance done to prevent failure',
                    ],
                    [
                         'question' => 'What does PLC stand for?',
                         'options' => ['Programmable Logic Controller', 'Public Limited Company', 'Power Line Communication', 'Private Logic Circuit'],
                         'correct' => 'Programmable Logic Controller',
                    ],
                    [
                         'question' => 'Hydraulics systems use...',
                         'options' => ['Liquid fluid under pressure', 'Compressed air', 'Electricity only', 'Gears only'],
                         'correct' => 'Liquid fluid under pressure',
                    ],
                    [
                         'question' => 'What is the function of a bearing?',
                         'options' => ['To reduce friction between moving parts', 'To stop the machine', 'To increase heat', 'To clean oil'],
                         'correct' => 'To reduce friction between moving parts',
                    ],
                    [
                         'question' => 'Multimeter is used to measure...',
                         'options' => ['Voltage, Current, Resistance', 'Temperature only', 'Speed', 'Distance'],
                         'correct' => 'Voltage, Current, Resistance',
                    ],
               ];
             case 'IT & Digital':
               return [
                    [
                         'question' => 'What is ERP?',
                         'options' => ['Enterprise Resource Planning', 'Electronic Research Program', 'Efficient Resource Process', 'Entry Reporting Protocol'],
                         'correct' => 'Enterprise Resource Planning',
                    ],
                    [
                         'question' => 'Which software is used for CAD?',
                         'options' => ['AutoCAD', 'Word', 'Excel', 'Outlook'],
                         'correct' => 'AutoCAD',
                    ],
                    [
                         'question' => 'Phishing is...',
                         'options' => ['A cyber attack using fake emails', 'A type of fishing sport', 'Installing software', 'Updating antivirus'],
                         'correct' => 'A cyber attack using fake emails',
                    ],
                    [
                         'question' => 'What is Cloud Computing?',
                         'options' => ['Storing and accessing data over the internet', 'Computing in high altitude', 'Using weather forecast', 'Printing on cloud paper'],
                         'correct' => 'Storing and accessing data over the internet',
                    ],
                     [
                         'question' => 'Data analysis helps in...',
                         'options' => ['Making informed decisions', 'Confusing employees', 'Deleting files', 'Slowing down computers'],
                         'correct' => 'Making informed decisions',
                    ],
               ];
            default:
                return [
                    ['question' => 'General Question 1?', 'options' => ['A', 'B', 'C', 'D'], 'correct' => 'A'],
                    ['question' => 'General Question 2?', 'options' => ['A', 'B', 'C', 'D'], 'correct' => 'A'],
                    ['question' => 'General Question 3?', 'options' => ['A', 'B', 'C', 'D'], 'correct' => 'A'],
                    ['question' => 'General Question 4?', 'options' => ['A', 'B', 'C', 'D'], 'correct' => 'A'],
                    ['question' => 'General Question 5?', 'options' => ['A', 'B', 'C', 'D'], 'correct' => 'A'],
                ];
        }
    }
}
