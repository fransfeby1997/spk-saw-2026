<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User (only if not exists)
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Create Kriteria (SAW Criteria)
        $kriteria = [
            ['nama_kriteria' => 'Kedisiplinan', 'jenis_kriteria' => 'Benefit', 'bobot_kriteria' => 25],
            ['nama_kriteria' => 'Kualitas Mengajar', 'jenis_kriteria' => 'Benefit', 'bobot_kriteria' => 30],
            ['nama_kriteria' => 'Kehadiran', 'jenis_kriteria' => 'Benefit', 'bobot_kriteria' => 20],
            ['nama_kriteria' => 'Pelanggaran', 'jenis_kriteria' => 'Cost', 'bobot_kriteria' => 15],
            ['nama_kriteria' => 'Pengalaman Kerja', 'jenis_kriteria' => 'Benefit', 'bobot_kriteria' => 10],
        ];

        foreach ($kriteria as $k) {
            Kriteria::firstOrCreate(
                ['nama_kriteria' => $k['nama_kriteria']],
                $k
            );
        }

        // Create Pegawai/Guru Data
        $pegawai = [
            ['nip' => '19671007 199003 2 002', 'nama_guru' => 'Roida Rusliana', 'tgl_lahir' => '1982-01-01', 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Duri'],
            ['nip' => '19711123 199201 2 001', 'nama_guru' => 'Arry Anggi', 'tgl_lahir' => '2006-02-12', 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Pekanbaru'],
            ['nip' => '19680521 199101 1 001', 'nama_guru' => 'Elpi Amelia', 'tgl_lahir' => '2001-03-27', 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Dumai'],
            ['nip' => '19680510 199101 1 004', 'nama_guru' => 'Sofinah', 'tgl_lahir' => '2017-02-07', 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Pangkalan Kerinci'],
            ['nip' => '197801012005022000', 'nama_guru' => 'Ijang Mulyana', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Duri'],
            ['nip' => '196805101991011004', 'nama_guru' => 'Wahyu Widodo', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Dumai'],
            ['nip' => '197510151998032004', 'nama_guru' => 'Ika Mustika', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Pekanbaru'],
            ['nip' => '198002132006042006', 'nama_guru' => 'Roslyna Herawati', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Analisa Lab Ahli', 'alamat' => 'Pekanbaru'],
            ['nip' => '197707212005022005', 'nama_guru' => 'Farentina', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Dumai'],
            ['nip' => '197201051991011001', 'nama_guru' => 'Dadang', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Pekanbaru'],
            ['nip' => '198105252010012021', 'nama_guru' => 'Elni Suzana', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Kesmas', 'alamat' => 'Pekanbaru'],
            ['nip' => '197903252010012014', 'nama_guru' => 'Masrita Sinaga', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Nutrisionis Terampil', 'alamat' => 'Pekanbaru'],
            ['nip' => '198010072010011015', 'nama_guru' => 'Masrukin', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Duri'],
            ['nip' => '197511242005022001', 'nama_guru' => 'Herawati Siregar', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Pekanbaru'],
            ['nip' => '198809142019032001', 'nama_guru' => 'Amin Suliah', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Ners', 'alamat' => 'Pekanbaru'],
            ['nip' => '198611262019032001', 'nama_guru' => 'Marda Wira', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Ahli', 'alamat' => 'Pekanbaru'],
            ['nip' => '198303152006041005', 'nama_guru' => 'Suwito', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Medan'],
            ['nip' => '197610162006042008', 'nama_guru' => 'Husniyati', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Jambi'],
            ['nip' => '198609272010012033', 'nama_guru' => 'Afifatul Husna', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Pekanbaru'],
            ['nip' => '198001232019052000', 'nama_guru' => 'Julia Betri Ningsih', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Pekanbaru'],
            ['nip' => '198607082017052003', 'nama_guru' => 'Lichomsatun', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Medan'],
            ['nip' => '98903082011022002', 'nama_guru' => 'Irawati', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Palembang'],
            ['nip' => '198401202017052002', 'nama_guru' => 'Wiwik Sri Rahayu', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Jambi'],
            ['nip' => '198507252017052002', 'nama_guru' => 'Yuhardina', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Bidan Ahli', 'alamat' => 'Palembang'],
            ['nip' => '197703162006042015', 'nama_guru' => 'Elly Asniar', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Lampung'],
            ['nip' => '198809272011022003', 'nama_guru' => 'Nova Eran', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Kesling', 'alamat' => 'Pekanbaru'],
            ['nip' => '196808251992031003', 'nama_guru' => 'Ishak', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Bendahara Rutin', 'alamat' => 'Pekanbaru'],
            ['nip' => '198005052005022004', 'nama_guru' => 'Dwi May Cristiana', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Perawat Gigi', 'alamat' => 'Pekanbaru'],
            ['nip' => '198408122017052001', 'nama_guru' => 'Yusnani Sirait', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Bengkulu'],
            ['nip' => '198409052017052002', 'nama_guru' => 'Ratna Sari Dewi', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Pekanbaru'],
            ['nip' => '199001262017052002', 'nama_guru' => 'Vamela Elvia', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Jakarta'],
            ['nip' => '198806102015031002', 'nama_guru' => 'Seto Setiawan', 'tgl_lahir' => null, 'jenis_kelamin' => 'Laki-laki', 'jabatan' => 'Perawat Terampil', 'alamat' => 'Medan'],
            ['nip' => '199111092019031001', 'nama_guru' => 'Novi Andianto', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Apoteker', 'alamat' => 'Pekanbaru'],
            ['nip' => '197107132019052001', 'nama_guru' => 'Lindawati', 'tgl_lahir' => null, 'jenis_kelamin' => 'Perempuan', 'jabatan' => 'Bidan Terampil', 'alamat' => 'Pekanbaru'],
        ];

        foreach ($pegawai as $p) {
            Guru::firstOrCreate(
                ['nip' => $p['nip']],
                $p
            );
        }
    }
}
