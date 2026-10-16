<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\Lesson;
use App\Models\Quiz;             
use App\Models\Question;
use App\Models\Announcement;
use App\Models\QuizAttempt;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrialDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Departments
        $deptIT = Department::firstOrCreate(['code' => 'IT'], ['name' => 'Information Technology']);
        $deptHR = Department::firstOrCreate(['code' => 'HR'], ['name' => 'Human Resources']);
        $deptProd = Department::firstOrCreate(['code' => 'PROD'], ['name' => 'Production']);
        $deptHSE = Department::firstOrCreate(['code' => 'HSE'], ['name' => 'Health, Safety & Environment']);
        $deptQC = Department::firstOrCreate(['code' => 'QC'], ['name' => 'Quality Control']);
        $deptMaint = Department::firstOrCreate(['code' => 'MAINT'], ['name' => 'Maintenance']);
        $deptPPIC = Department::firstOrCreate(['code' => 'PPIC'], ['name' => 'Production Planning & Inventory Control']);
        $deptGA = Department::firstOrCreate(['code' => 'GA'], ['name' => 'General Affairs']);

        // --------------------------------------------------------------------------------
        // 2. Course: K3 General Safety (Mandatory)
        // --------------------------------------------------------------------------------
        $courseK3 = Course::firstOrCreate(
            ['title' => 'Induksi Keselamatan Kerja (K3) - Level 1'],
            [
                'description' => 'Pelatihan wajib bagi seluruh karyawan baru mengenai standar keselamatan kerja di area pabrik PT SPINDO.',
                'is_published' => true,
            ]
        );

        if ($courseK3->wasRecentlyCreated) {
            Lesson::create([
                'course_id' => $courseK3->id,
                'title' => 'Pengenalan APD (Alat Pelindung Diri)',
                'content_type' => 'video',
                'content_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Dummy
                'sort_order' => 1,
            ]);
            Lesson::create([
                'course_id' => $courseK3->id,
                'title' => 'Prosedur Evakuasi Darurat',
                'content_type' => 'text',
                'content_body' => '<h1>Prosedur Evakuasi</h1><p>Jika terdengar alarm panjang:</p><ol><li>Hentikan pekerjaan segara.</li><li>Matikan mesin.</li><li>Berjalan (jangan berlari) menuju titik kumpul (Assembly Point).</li></ol>',
                'sort_order' => 2,
            ]);
        }

        $quizK3 = Quiz::firstOrCreate(
            ['course_id' => $courseK3->id],
            [
                'title' => 'Evaluasi Pemahaman Dasar K3',
                'description' => 'Quiz untuk menguji pemahaman Anda tentang materi Induksi Keselamatan Kerja.',
                'passing_percentage' => 80,
            ]
        );

        $this->seedQuestions($quizK3, [
            [
                'text' => 'Apa kepanjangan dari APD?',
                'options' => ['Alat Pelindung Diri', 'Alat Pemadam Dasar', 'Aman Peduli Disiplin', 'Asosiasi Pekerja Depan'],
                'correct' => 'Alat Pelindung Diri'
            ],
            [
                'text' => 'Apa yang harus dilakukan jika mendengar alarm evakuasi panjang?',
                'options' => [
                    'Tetap bekerja seperti biasa', 
                    'Berlari panik keluar gedung', 
                    'Hentikan pekerjaan, matikan mesin, dan berjalan ke titik kumpul',
                    'Sembunyi di bawah meja'
                ],
                'correct' => 'Hentikan pekerjaan, matikan mesin, dan berjalan ke titik kumpul'
            ],
            [
                'text' => 'Warna helm safety standar untuk operator produksi adalah?',
                'options' => ['Putih', 'Kuning', 'Merah', 'Hijau'],
                'correct' => 'Kuning'
            ],
            [
                'text' => 'Berapa batas kebisingan maksimum yang diperbolehkan tanpa pelindung telinga (Earplug)?',
                'options' => ['60 dB', '75 dB', '85 dB', '100 dB'],
                'correct' => '85 dB'
            ],
            [
                'text' => 'Jenis APAR (Alat Pemadam Api Ringan) yang paling cocok untuk kebakaran listrik (Korsleting) adalah?',
                'options' => ['Air', 'CO2 (Carbon Dioxide)', 'Busa (Foam)', 'Pasir'],
                'correct' => 'CO2 (Carbon Dioxide)'
            ]
        ]);


        // --------------------------------------------------------------------------------
        // 3. Course: SOP Slitting
        // --------------------------------------------------------------------------------
        $courseSOP = Course::firstOrCreate(
            ['title' => 'SOP Operasional Mesin Slitting'],
            [
                'description' => 'Panduan teknis pengoperasian mesin Slitting untuk operator produksi.',
                'is_published' => true,
            ]
        );

        if ($courseSOP->wasRecentlyCreated) {
            Lesson::create([
                'course_id' => $courseSOP->id,
                'title' => 'Manual Book Mesin Slitting',
                'content_type' => 'pdf',
                'content_url' => 'http://www.africau.edu/images/default/sample.pdf',
                'sort_order' => 1,
            ]);
            Lesson::create([
                'course_id' => $courseSOP->id,
                'title' => 'Video Tutorial: Setup Awal',
                'content_type' => 'video',
                'content_url' => 'https://www.youtube.com/watch?v=ScMzIvxBSi4',
                'sort_order' => 2,
            ]);
        }

        $quizSOP = Quiz::firstOrCreate(
            ['course_id' => $courseSOP->id],
            [
                'title' => 'Ujian Sertifikasi Operator Slitting',
                'description' => 'Tes kemampuan operasional mesin Slitting sesuai standar SOP.',
                'passing_percentage' => 75,
            ]
        );

        $this->seedQuestions($quizSOP, [
            [
                'text' => 'Langkah pertama sebelum menyalakan mesin Slitting adalah?',
                'options' => [
                    'Langsung menekan tombol START',
                    'Melakukan pemeriksaan visual (Visual Check) dan memastikan area aman', 
                    'Makan siang terlebih dahulu',
                    'Memanggil supervisor'
                ],
                'correct' => 'Melakukan pemeriksaan visual (Visual Check) dan memastikan area aman'
            ],
            [
                'text' => 'Apa fungsi tombol Emergency Stop?',
                'options' => [
                    'Untuk mematikan mesin saat istirahat',
                    'Menghentikan seluruh operasi mesin seketika dalam kondisi darurat',
                    'Mempercepat putaran mesin',
                    'Mereset counter produksi'
                ],
                'correct' => 'Menghentikan seluruh operasi mesin seketika dalam kondisi darurat'
            ],
            [
                'text' => 'Cacat potong "Burr" (kasar pada pinggiran strip) biasanya disebabkan oleh?',
                'options' => [
                    'Kecepatan mesin terlalu lambat',
                    'Gap antara pisau (Clearance) tidak sesuai',
                    'Bahan baku terlalu bagus',
                    'Operator mengantuk'
                ],
                'correct' => 'Gap antara pisau (Clearance) tidak sesuai'
            ],
            [
                'text' => 'Berapa frekuensi pengecekan dimensi lebar strip yang disarankan?',
                'options' => [
                    'Setiap awal shift saja',
                    'Setiap ganti coil baru atau settingan baru',
                    'Seminggu sekali',
                    'Tidak perlu dicek'
                ],
                'correct' => 'Setiap ganti coil baru atau settingan baru'
            ],
            [
                'text' => 'APD khusus apa yang WAJIB digunakan saat mengganti pisau slitting yang tajam?',
                'options' => [
                    'Sarung tangan kain biasa',
                    'Sarung tangan Anti-Cut (Cut Resistant Gloves)',
                    'Sarung tangan plastik',
                    'Tanpa sarung tangan agar lebih presisi'
                ],
                'correct' => 'Sarung tangan Anti-Cut (Cut Resistant Gloves)'
            ]
        ]);

        // --------------------------------------------------------------------------------
        // 4. Course: Manufacturing Process
        // --------------------------------------------------------------------------------
        $courseMfg = Course::firstOrCreate(
            ['title' => 'Proses Pembuatan Pipa Baja (ERW & SAW)'],
            [
                'description' => 'Memahami perbedaan metode Electric Resistance Welding (ERW) dan Submerged Arc Welding (SAW) dalam produksi pipa SPINDO.',
                'is_published' => true,
            ]
        );

        $quizMfg = Quiz::firstOrCreate(
            ['course_id' => $courseMfg->id],
            [
                'title' => 'Ujian Teknis Produksi Pipa',
                'description' => 'Evaluasi pengetahuan teknis tentang metode ERW dan SAW.',
                'passing_percentage' => 80,
            ]
        );

        $this->seedQuestions($quizMfg, [
            [
                'text' => 'Apa perbedaan utama visual antara pipa ERW dan SSAW?',
                'options' => [
                    'Tidak ada bedanya',
                    'Pipa ERW memiliki sambungan lurus (memanjang), SSAW memiliki sambungan spiral',
                    'Pipa ERW berwarna merah, SSAW berwarna biru',
                    'Pipa ERW berbahan plastik, SSAW berbahan baja'
                ],
                'correct' => 'Pipa ERW memiliki sambungan lurus (memanjang), SSAW memiliki sambungan spiral'
            ],
            [
                'text' => 'Bahan baku utama (Raw Material) dalam pembuatan pipa baja adalah?',
                'options' => ['Biji Besi', 'HRC (Hot Rolled Coil)', 'Scrap Metal', 'Aluminum'],
                'correct' => 'HRC (Hot Rolled Coil)'
            ],
            [
                'text' => 'Tujuan utama dari proses Hydrostatic Test adalah?',
                'options' => [
                    'Membersihkan pipa dari debu',
                    'Menguji ketahanan kebocoran pipa dengan tekanan air tinggi',
                    'Mengecat pipa',
                    'Menimbang berat pipa'
                ],
                'correct' => 'Menguji ketahanan kebocoran pipa dengan tekanan air tinggi'
            ],
            [
                'text' => 'Berapa standar panjang umum pipa SPINDO di pasaran?',
                'options' => ['2 meter', '6 meter & 12 meter', '20 meter', '50 meter'],
                'correct' => '6 meter & 12 meter'
            ],
            [
                'text' => 'Cacat "Undercut" biasanya terjadi pada proses apa?',
                'options' => ['Slitting', 'Forming', 'Welding (Pengelasan)', 'Packing'],
                'correct' => 'Welding (Pengelasan)'
            ]
        ]);

        // --------------------------------------------------------------------------------
        // 5. Course: Quality Control
        // --------------------------------------------------------------------------------
        $courseQC = Course::firstOrCreate(
            ['title' => 'Standar Quality Control Pipa API 5L'],
            [
                'description' => 'Pelatihan standar kualitas internasional API 5L untuk pipa minyak dan gas.',
                'is_published' => true,
            ]
        );

        $quizQC = Quiz::firstOrCreate(
            ['course_id' => $courseQC->id],
            [
                'title' => 'Sertifikasi QC Inspector Level 1',
                'description' => 'Ujian kualifikasi dasar bagi inspektor QC pipa standar API.',
                'passing_percentage' => 85,
            ]
        );

        $this->seedQuestions($quizQC, [
            [
                'text' => 'API adalah singkatan dari standar internasional apa?',
                'options' => ['Asian Pipe Industry', 'American Petroleum Institute', 'Association of Pipe Inspectors', 'All Pipe International'],
                'correct' => 'American Petroleum Institute'
            ],
            [
                'text' => 'Alat ukur presisi untuk mengukur ketebalan dinding pipa adalah?',
                'options' => ['Meteran Roll', 'Ultrasonic Thickness Gauge', 'Timbangan Digital', 'Penggaris Besi'],
                'correct' => 'Ultrasonic Thickness Gauge'
            ],
            [
                'text' => 'Manakah yang termasuk kategori Reject visual?',
                'options' => ['Pipa lurus sempurna', 'Penyok (Dent) pada body pipa', 'Warna pipa abu-abu', 'Ada stensil merk'],
                'correct' => 'Penyok (Dent) pada body pipa'
            ],
            [
                'text' => 'Dokumen MTC yang menyertai pengiriman pipa adalah singkatan dari?',
                'options' => ['Material Transfer Code', 'Mill Test Certificate', 'Main Technical Check', 'Machine Test Control'],
                'correct' => 'Mill Test Certificate'
            ],
            [
                'text' => 'Pengujian laboratorium untuk mengetahui kekuatan tarik bahan disebut?',
                'options' => ['Tensile Test', 'Bending Test', 'Impact Test', 'Flavor Test'],
                'correct' => 'Tensile Test'
            ]
        ]);

        // --------------------------------------------------------------------------------
        // 6. Course: Corporate Values
        // --------------------------------------------------------------------------------
        $courseValues = Course::firstOrCreate(
            ['title' => 'SPINDO Corporate Values (AKHLAK)'],
            [
                'description' => 'Internalisasi nilai-nilai utama perusahaan untuk membentuk karakter insan SPINDO yang unggul.',
                'is_published' => true,
            ]
        );

        $quizValues = Quiz::firstOrCreate(
            ['course_id' => $courseValues->id],
            [
                'title' => 'Quiz Nilai-Nilai Utama (AKHLAK)',
                'description' => 'Seberapa baik Anda memahami nilai-nilai perusahaan?',
                'passing_percentage' => 90,
            ]
        );

        $this->seedQuestions($quizValues, [
            [
                'text' => 'Manakah yang termasuk perilaku Integritas?',
                'options' => [
                    'Datang terlambat tanpa kabar',
                    'Jujur dan konsisten dalam tindakan',
                    'Menyembunyikan kesalahan kerja',
                    'Mengambil barang perusahaan tanpa izin'
                ],
                'correct' => 'Jujur dan konsisten dalam tindakan'
            ],
            [
                'text' => 'Nilai "Kerjasama" (Teamwork) paling baik dicerminkan dengan?',
                'options' => [
                    'Bekerja sendiri-sendiri agar cepat',
                    'Saling membantu antar departemen untuk mencapai tujuan bersama',
                    'Menyalahkan tim lain jika ada masalah',
                    'Hanya peduli pada tugas pribadi'
                ],
                'correct' => 'Saling membantu antar departemen untuk mencapai tujuan bersama'
            ],
            [
                'text' => '"Fokus pada Pelanggan" berarti?',
                'options' => [
                    'Mengabaikan keluhan pelanggan',
                    'Memberikan respon cepat dan solusi terbaik bagi kebutuhan pelanggan',
                    'Meminta tip kepada pelanggan',
                    'Menolak pesanan yang sulit'
                ],
                'correct' => 'Memberikan respon cepat dan solusi terbaik bagi kebutuhan pelanggan'
            ],
            [
                'text' => 'Contoh perilaku "Inovasi" di lingkungan pabrik adalah?',
                'options' => [
                    'Melakukan pekerjaan dengan cara lama yang tidak efisien',
                    'Mengajukan ide perbaikan (Kaizen/Improvement) untuk efisiensi produksi',
                    'Menolak teknologi baru',
                    'Takut mencoba hal baru'
                ],
                'correct' => 'Mengajukan ide perbaikan (Kaizen/Improvement) untuk efisiensi produksi'
            ],
            [
                'text' => 'Apakah "Safety First" merupakan bagian dari budaya kerja SPINDO?',
                'options' => [
                    'Tidak, produksi lebih penting',
                    'Ya, Keselamatan adalah prioritas utama di atas segalanya',
                    'Hanya saat ada audit',
                    'Mungkin'
                ],
                'correct' => 'Ya, Keselamatan adalah prioritas utama di atas segalanya'
            ]
        ]);
        
        // ================================================================================
        // 7. CREATE USERS FROM VARIOUS DEPARTMENTS
        // ================================================================================
        $admin = User::firstOrCreate(
            ['email' => 'admin@spindo.com'],
            ['name' => 'Administrator', 'password' => bcrypt('password'), 'department_id' => $deptIT->id, 'is_admin' => true]
        );

        $userBudi = User::firstOrCreate(
            ['email' => 'budi@spindo.com'],
            ['name' => 'Budi Santoso', 'password' => bcrypt('password'), 'department_id' => $deptProd->id]
        );

        $userSiti = User::firstOrCreate(
            ['email' => 'siti@spindo.com'],
            ['name' => 'Siti Rahayu', 'password' => bcrypt('password'), 'department_id' => $deptHR->id]
        );

        $userAgus = User::firstOrCreate(
            ['email' => 'agus@spindo.com'],
            ['name' => 'Agus Wijaya', 'password' => bcrypt('password'), 'department_id' => $deptProd->id]
        );

        $userDewi = User::firstOrCreate(
            ['email' => 'dewi@spindo.com'],
            ['name' => 'Dewi Lestari', 'password' => bcrypt('password'), 'department_id' => $deptQC->id]
        );

        $userRudi = User::firstOrCreate(
            ['email' => 'rudi@spindo.com'],
            ['name' => 'Rudi Hermawan', 'password' => bcrypt('password'), 'department_id' => $deptMaint->id]
        );

        $userNina = User::firstOrCreate(
            ['email' => 'nina@spindo.com'],
            ['name' => 'Nina Safitri', 'password' => bcrypt('password'), 'department_id' => $deptHSE->id]
        );

        $userAndi = User::firstOrCreate(
            ['email' => 'andi@spindo.com'],
            ['name' => 'Andi Prasetyo', 'password' => bcrypt('password'), 'department_id' => $deptPPIC->id]
        );

        $userMaya = User::firstOrCreate(
            ['email' => 'maya@spindo.com'],
            ['name' => 'Maya Putri', 'password' => bcrypt('password'), 'department_id' => $deptGA->id]
        );

        // ================================================================================
        // 8. ENROLLMENTS - Assign users to courses
        // ================================================================================
        // K3 is mandatory for all
        $allLearners = [$userBudi, $userSiti, $userAgus, $userDewi, $userRudi, $userNina, $userAndi, $userMaya];
        foreach ($allLearners as $user) {
            $user->courses()->syncWithoutDetaching([$courseK3->id]);
        }

        // Production team: SOP Slitting, Manufacturing Process
        $userBudi->courses()->syncWithoutDetaching([$courseSOP->id, $courseMfg->id]);
        $userAgus->courses()->syncWithoutDetaching([$courseSOP->id, $courseMfg->id]);

        // QC team: QC API 5L
        $userDewi->courses()->syncWithoutDetaching([$courseQC->id, $courseMfg->id]);

        // HR team: Corporate Values
        $userSiti->courses()->syncWithoutDetaching([$courseValues->id]);
        $userMaya->courses()->syncWithoutDetaching([$courseValues->id]);

        // HSE team: all safety courses
        $userNina->courses()->syncWithoutDetaching([$courseMfg->id, $courseQC->id]);

        // Maintenance: Manufacturing Process
        $userRudi->courses()->syncWithoutDetaching([$courseMfg->id]);

        // PPIC: Manufacturing, QC
        $userAndi->courses()->syncWithoutDetaching([$courseMfg->id, $courseQC->id]);

        // ================================================================================
        // 9. QUIZ ATTEMPTS - Create quiz results
        // ================================================================================
        // Budi passed K3 and Slitting
        $this->createQuizAttempt($userBudi, $quizK3, 100, true);
        $this->createQuizAttempt($userBudi, $quizSOP, 80, true);
        $this->createQuizAttempt($userBudi, $quizMfg, 85, true);

        // Agus passed K3, failed Slitting once, then passed
        $this->createQuizAttempt($userAgus, $quizK3, 90, true);
        $this->createQuizAttempt($userAgus, $quizSOP, 60, false); // Failed first attempt
        $this->createQuizAttempt($userAgus, $quizSOP, 85, true);  // Passed retry

        // Siti passed K3 and Corporate Values
        $this->createQuizAttempt($userSiti, $quizK3, 95, true);
        $this->createQuizAttempt($userSiti, $quizValues, 100, true);

        // Dewi passed K3 and QC
        $this->createQuizAttempt($userDewi, $quizK3, 85, true);
        $this->createQuizAttempt($userDewi, $quizQC, 90, true);

        // Rudi passed K3
        $this->createQuizAttempt($userRudi, $quizK3, 80, true);

        // Nina passed K3 and Manufacturing
        $this->createQuizAttempt($userNina, $quizK3, 100, true);
        $this->createQuizAttempt($userNina, $quizMfg, 95, true);

        // Andi passed K3, in progress for QC
        $this->createQuizAttempt($userAndi, $quizK3, 85, true);

        // Maya passed K3, attempting Values
        $this->createQuizAttempt($userMaya, $quizK3, 90, true);
        $this->createQuizAttempt($userMaya, $quizValues, 80, false); // Failed first attempt

        // ================================================================================
        // 10. CERTIFICATES - Create certificates for passed quizzes
        // ================================================================================
        $this->createCertificate($userBudi, $courseK3, 'Induksi K3 Level 1');
        $this->createCertificate($userBudi, $courseSOP, 'Operator Slitting Bersertifikat');
        $this->createCertificate($userBudi, $courseMfg, 'Pengetahuan Produksi Pipa');

        $this->createCertificate($userAgus, $courseK3, 'Induksi K3 Level 1');
        $this->createCertificate($userAgus, $courseSOP, 'Operator Slitting Bersertifikat');

        $this->createCertificate($userSiti, $courseK3, 'Induksi K3 Level 1');
        $this->createCertificate($userSiti, $courseValues, 'SPINDO Corporate Values');

        $this->createCertificate($userDewi, $courseK3, 'Induksi K3 Level 1');
        $this->createCertificate($userDewi, $courseQC, 'QC Inspector Level 1');

        $this->createCertificate($userRudi, $courseK3, 'Induksi K3 Level 1');

        $this->createCertificate($userNina, $courseK3, 'Induksi K3 Level 1');
        $this->createCertificate($userNina, $courseMfg, 'Pengetahuan Produksi Pipa');

        $this->createCertificate($userAndi, $courseK3, 'Induksi K3 Level 1');

        $this->createCertificate($userMaya, $courseK3, 'Induksi K3 Level 1');

        // ================================================================================
        // 11. ANNOUNCEMENTS - Company announcements
        // ================================================================================
        Announcement::firstOrCreate(
            ['title' => 'Jadwal Shutdown Maintenance Tahunan 2026'],
            [
                'content' => 'Kepada seluruh karyawan, diberitahukan bahwa akan dilakukan Shutdown Maintenance tahunan pada tanggal 15-20 Maret 2026. Seluruh aktivitas produksi akan dihentikan sementara. Gunakan waktu ini untuk mengikuti pelatihan online yang tersedia di LMS. Terima kasih atas pengertiannya.',
                'type' => 'warning',
                'is_active' => true,
                'published_at' => now()->subDays(2),
                'expires_at' => now()->addDays(30),
                'created_by' => $admin->id,
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Selamat! 10 Tahun Zero Fatality'],
            [
                'content' => 'Dengan bangga kami umumkan bahwa PT SPINDO telah berhasil mencapai 10 tahun berturut-turut tanpa kecelakaan fatal (Zero Fatality). Ini adalah pencapaian luar biasa berkat komitmen seluruh karyawan terhadap budaya Safety First. Mari terus jaga keselamatan bersama!',
                'type' => 'success',
                'is_active' => true,
                'published_at' => now()->subDays(5),
                'expires_at' => now()->addDays(60),
                'created_by' => $admin->id,
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Pelatihan Wajib K3 untuk Karyawan Baru'],
            [
                'content' => 'Bagi seluruh karyawan baru yang bergabung di bulan Februari 2026, WAJIB menyelesaikan pelatihan "Induksi Keselamatan Kerja (K3) - Level 1" dalam waktu 7 hari kerja pertama. Akses pelatihan melalui menu "My Learning" di dashboard.',
                'type' => 'info',
                'is_active' => true,
                'published_at' => now(),
                'expires_at' => now()->addDays(14),
                'created_by' => $admin->id,
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Update Sistem LMS - Fitur Baru'],
            [
                'content' => 'Sistem LMS telah diperbarui dengan fitur-fitur baru: 1) Sertifikat Digital yang bisa didownload, 2) Quiz interaktif dengan nilai langsung, 3) Progress tracking visual. Silakan explore dan berikan feedback melalui menu Support.',
                'type' => 'info',
                'is_active' => true,
                'published_at' => now()->subDay(),
                'expires_at' => now()->addDays(7),
                'created_by' => $admin->id,
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Peringatan: Area Berbahaya di Plant 2'],
            [
                'content' => 'PERHATIAN! Sedang dilakukan pekerjaan perbaikan struktur di area Plant 2 Zona C. Seluruh karyawan DILARANG memasuki area tersebut tanpa izin khusus dari tim HSE. Gunakan jalur alternatif yang sudah ditandai.',
                'type' => 'danger',
                'is_active' => true,
                'published_at' => now(),
                'expires_at' => now()->addDays(3),
                'created_by' => $admin->id,
            ]
        );

        $this->command->info('✅ SPINDO LMS Dummy Data seeded successfully!');
        $this->command->info('   - 8 Departments');
        $this->command->info('   - 9 Users (8 Learners + 1 Admin)');
        $this->command->info('   - 6 Courses with Quizzes');
        $this->command->info('   - 15+ Quiz Attempts');
        $this->command->info('   - 12 Certificates');
        $this->command->info('   - 5 Announcements');
    }

    private function seedQuestions(Quiz $quiz, array $questionsData)
    {
        foreach ($questionsData as $index => $q) {
            Question::firstOrCreate(
                [
                    'quiz_id' => $quiz->id,
                    'question_text' => $q['text']
                ],
                [
                    'question_type' => 'multiple_choice',
                    'options' => array_map(fn($opt) => ['text' => $opt], $q['options']),
                    'correct_answer' => $q['correct'],
                    'sort_order' => $index + 1
                ]
            );
        }
    }

    private function createQuizAttempt(User $user, Quiz $quiz, int $score, bool $passed): void
    {
        QuizAttempt::firstOrCreate(
            [
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
            ],
            [
                'score' => $score,
                'is_passed' => $passed,
                'completed_at' => now()->subDays(rand(1, 30)),
            ]
        );
    }

    private function createCertificate(User $user, Course $course, string $title): void
    {
        Certificate::firstOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
            ],
            [
                'certificate_number' => 'SPINDO-' . strtoupper(Str::random(8)),
                'issued_at' => now()->subDays(rand(1, 30)),
            ]
        );
    }
}

