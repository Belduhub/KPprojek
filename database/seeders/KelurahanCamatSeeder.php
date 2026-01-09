<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class KelurahanCamatSeeder extends Seeder
{
    public function run(): void
    {
        $output = [];

        // ======================
        // DATA KECAMATAN (21)
        // ======================
        $kecamatans = [
            'Muntilan', 'Kaliangkrik', 'Mungkid', 'Grabag',
            'Windusari', 'Kajoran', 'Bandongan', 'Ngablak',
            'Salaman', 'Mertoyudan', 'Srumbung', 'Dukun',
            'Sawangan', 'Tegalrejo', 'Pakis', 'Candimulyo',
            'Salam', 'Tempuran', 'Borobudur', 'Ngluwar', 'Secang'
        ];

        foreach ($kecamatans as $kecamatan) {

            $email = 'camat.' . strtolower(str_replace(' ', '', $kecamatan)) . '@magelang.go.id';

            if (User::where('email', $email)->exists()) {
                continue;
            }

            $password = Str::random(12) . '!';

            User::create([
                'name' => 'Camat ' . $kecamatan,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'camat',
                'wilayah' => null,
                'kecamatan' => $kecamatan,
                'must_change_password' => true,
            ]);

            $output[] = [
                'email' => $email,
                'password' => $password,
                'role' => 'camat',
                'wilayah' => '-',
                'kecamatan' => $kecamatan,
            ];
        }

        // ======================
        // DATA KELURAHAN (5)
        // ======================
        $kelurahans = [
            ['nama' => 'Sumberrejo', 'kecamatan' => 'Mertoyudan'],
            ['nama' => 'Sawitan', 'kecamatan' => 'Mungkid'],
            ['nama' => 'Muntilan', 'kecamatan' => 'Muntilan'],
            ['nama' => 'Secang', 'kecamatan' => 'Secang'],
            ['nama' => 'Mendut', 'kecamatan' => 'Mungkid'],
        ];

        foreach ($kelurahans as $kel) {

            $email = strtolower(str_replace(' ', '', $kel['nama'])) . '@magelang.go.id';

            if (User::where('email', $email)->exists()) {
                continue;
            }

            $password = Str::random(12) . '!';

            User::create([
                'name' => 'Lurah ' . $kel['nama'],
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'lurah',
                'wilayah' => $kel['nama'],
                'kecamatan' => $kel['kecamatan'],
                'must_change_password' => true,
            ]);

            $output[] = [
                'email' => $email,
                'password' => $password,
                'role' => 'lurah',
                'wilayah' => $kel['nama'],
                'kecamatan' => $kel['kecamatan'],
            ];
        }

        // ======================
        // SIMPAN PASSWORD SEKALI
        // ======================
        File::put(
            storage_path('app/password_akun_pemda.txt'),
            collect($output)->map(fn ($r) =>
                "{$r['role']} | {$r['email']} | {$r['password']} | {$r['wilayah']} | {$r['kecamatan']}"
            )->implode("\n")
        );

        $this->command->info('Seeder akun kecamatan & kelurahan selesai.');
        $this->command->info('Password tersimpan di storage/app/password_akun_pemda.txt');
    }
}
