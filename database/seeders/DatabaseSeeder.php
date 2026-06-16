<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DosenKeahlian;
use App\Models\Berita;
use App\Models\InfoLomba;
use App\Models\PengajuanLomba;
use App\Models\ProgressBimbingan;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
        * Seed the application's database.
        */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@prestasi.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Dosen & Keahliannya
        $dosen1 = User::create([
            'name' => 'Dr. Budi Santoso, M.Kom.',
            'email' => 'dosen1@prestasi.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        DosenKeahlian::create(['user_id' => $dosen1->id, 'bidang_keahlian' => 'Kecerdasan Buatan & Data Mining']);

        $dosen2 = User::create([
            'name' => 'Siti Aminah, S.T., M.T.',
            'email' => 'dosen2@prestasi.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        DosenKeahlian::create(['user_id' => $dosen2->id, 'bidang_keahlian' => 'Pengembangan Web & Aplikasi Mobile']);

        $dosen3 = User::create([
            'name' => 'Prof. Dr. Andi Wijaya',
            'email' => 'dosen3@prestasi.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        DosenKeahlian::create(['user_id' => $dosen3->id, 'bidang_keahlian' => 'Internet of Things & Robotika']);

        // 3. Buat Akun Mahasiswa
        $mahasiswas = [];
        for ($i = 1; $i <= 5; $i++) {
            $mahasiswas[] = User::create([
                'name' => 'Mahasiswa Teladan ' . $i,
                'email' => 'mahasiswa' . $i . '@prestasi.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]);
        }

        // 4. Buat Info Lomba
        $lomba1 = InfoLomba::create([
            'judul' => 'GEMASTIK XVII 2026',
            'penyelenggara' => 'Puspresnas Kemdikbudristek',
            'deskripsi' => 'Pagelaran Mahasiswa Nasional Bidang Teknologi Informasi dan Komunikasi. Ajang terbesar untuk unjuk gigi di bidang TIK dengan berbagai divisi seperti Pemrograman, UX Design, Keamanan Siber, dan lainnya.',
            'tanggal_batas' => Carbon::now()->addDays(30),
            'link_pendaftaran' => 'https://gemastik.kemdikbud.go.id',
            'created_at' => Carbon::now()->subDays(2),
        ]);

        $lomba2 = InfoLomba::create([
            'judul' => 'Program Kreativitas Mahasiswa (PKM) 2026',
            'penyelenggara' => 'Ditjen Diktiristek',
            'deskripsi' => 'PKM adalah wadah yang dibentuk untuk memfasilitasi potensi yang dimiliki mahasiswa Indonesia untuk mengkaji, mengembangkan, dan menerapkan ilmu dan teknologi.',
            'tanggal_batas' => Carbon::now()->addDays(15),
            'link_pendaftaran' => 'https://simbelmawa.kemdikbud.go.id',
            'created_at' => Carbon::now()->subDays(5),
        ]);

        $lomba3 = InfoLomba::create([
            'judul' => 'Kontes Robot Indonesia (KRI) 2026',
            'penyelenggara' => 'Pusat Prestasi Nasional',
            'deskripsi' => 'Kompetisi rancang bangun dan rekayasa dalam bidang robotika. Kontes ini terdiri dari berbagai divisi lomba.',
            'tanggal_batas' => Carbon::now()->subDays(5), // Sudah tutup
            'link_pendaftaran' => 'https://kri.kemdikbud.go.id',
            'created_at' => Carbon::now()->subDays(30),
        ]);

        InfoLomba::create([
            'judul' => 'Hackathon Nasional BNI 2026',
            'penyelenggara' => 'PT Bank Negara Indonesia (Persero)',
            'deskripsi' => 'Ajang kompetisi coding selama 48 jam non-stop untuk menciptakan solusi digital perbankan yang inovatif.',
            'tanggal_batas' => Carbon::now()->addDays(45),
            'link_pendaftaran' => 'https://hackathon.bni.co.id',
            'created_at' => Carbon::now()->subDays(1),
        ]);

        // 5. Buat Berita Prestasi
        Berita::create([
            'judul' => 'Tim Fakultas Berhasil Meraih Medali Emas di GEMASTIK 2025',
            'konten' => 'Prestasi membanggakan kembali ditorehkan oleh tim mahasiswa Fakultas kita. Dalam ajang bergengsi GEMASTIK, tim berhasil membawa pulang medali emas di divisi Keamanan Siber. Dekan sangat mengapresiasi kerja keras tim dan dosen pembimbing.',
            'tanggal' => Carbon::now()->subDays(10),
        ]);

        Berita::create([
            'judul' => 'Tiga Proposal PKM Lolos Pendanaan Tahun Ini',
            'konten' => 'Kabar gembira! Tiga tim PKM kita secara resmi dinyatakan lolos untuk mendapatkan pendanaan dari Dikti. Ini merupakan peningkatan yang luar biasa dibandingkan tahun sebelumnya. Mari terus tingkatkan budaya riset dan inovasi di kampus.',
            'tanggal' => Carbon::now()->subDays(20),
        ]);

        Berita::create([
            'judul' => 'Juara 1 Lomba Web Design Tingkat Nasional',
            'konten' => 'Selamat kepada Mahasiswa Teladan 1 yang telah berhasil meraih Juara 1 pada kompetisi Web Design tingkat nasional yang diselenggarakan oleh Universitas Indonesia. Desain UI/UX yang dibuat diakui sangat modern dan user-friendly.',
            'tanggal' => Carbon::now()->subDays(2),
        ]);

        // 6. Buat Pengajuan Proposal Lomba
        // Pengajuan 1: ACC
        $pengajuan1 = PengajuanLomba::create([
            'mahasiswa_id' => $mahasiswas[0]->id, // Mahasiswa 1
            'dosen_id' => $dosen2->id, // Siti Aminah (Web)
            'judul_lomba' => 'Pengembangan Aplikasi Deteksi Dini Penyakit Kulit (GEMASTIK UX Design)',
            'file_proposal' => 'dummy_proposal.pdf', // Dummy path
            'status' => 'ACC',
            'catatan' => 'Proposal sangat bagus. Silakan lanjut ke tahap pembuatan prototipe. Jangan lupa update progress secara berkala.',
            'created_at' => Carbon::now()->subDays(15),
            'updated_at' => Carbon::now()->subDays(10),
        ]);

        // Progress Bimbingan untuk Pengajuan 1
        ProgressBimbingan::create([
            'pengajuan_id' => $pengajuan1->id,
            'keterangan' => 'Mengirimkan hasil wireframe low-fidelity untuk review awal.',
            'file_lampiran' => 'wireframe.pdf',
            'tanggapan_dosen' => 'Wireframe sudah oke, tapi perhatikan ukuran tombol agar lebih mudah di tap di layar HP.',
            'created_at' => Carbon::now()->subDays(8),
        ]);
        ProgressBimbingan::create([
            'pengajuan_id' => $pengajuan1->id,
            'keterangan' => 'Mengirimkan desain high-fidelity beserta prototipe figma.',
            'file_lampiran' => 'hifi.pdf',
            'tanggapan_dosen' => null, // Belum ditanggapi
            'created_at' => Carbon::now()->subDays(1),
        ]);

        // Pengajuan 2: Menunggu
        PengajuanLomba::create([
            'mahasiswa_id' => $mahasiswas[1]->id, // Mahasiswa 2
            'dosen_id' => $dosen1->id, // Budi Santoso (AI)
            'judul_lomba' => 'Implementasi Machine Learning untuk Prediksi Cuaca Pertanian (PKM)',
            'file_proposal' => 'dummy_proposal2.pdf',
            'status' => 'Menunggu',
            'created_at' => Carbon::now()->subDays(2),
        ]);

        // Pengajuan 3: Revisi
        PengajuanLomba::create([
            'mahasiswa_id' => $mahasiswas[2]->id, // Mahasiswa 3
            'dosen_id' => $dosen3->id, // Andi Wijaya (IoT)
            'judul_lomba' => 'Robot Pemungut Sampah Otomatis (KRI)',
            'file_proposal' => 'dummy_proposal3.pdf',
            'status' => 'Revisi',
            'catatan' => 'Tolong perbaiki bagian RAB (Rencana Anggaran Biaya), harganya banyak yang tidak masuk akal. Cek juga landasan teorinya.',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(1),
        ]);
    }
}
