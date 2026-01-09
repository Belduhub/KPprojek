<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminWilayahSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n=== AKUN PEMERINTAH KAB. MAGELANG ===\n\n";

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN (BUPATI)
        |--------------------------------------------------------------------------
        */
        $bupatiPassword = Str::random(10);

        User::create([
            'name' => 'Bupati Magelang',
            'email' => 'bupati@magelang.go.id',
            'password' => Hash::make($bupatiPassword),
            'role' => 'superadmin',
            'kecamatan' => null,
            'wilayah' => null,
            'must_change_password' => true,
        ]);

        echo "BUPATI\n";
        echo "Email    : bupati@magelang.go.id\n";
        echo "Password : {$bupatiPassword}\n\n";

        /*
        |--------------------------------------------------------------------------
        | CAMAT (21)
        |--------------------------------------------------------------------------
        */
        $kecamatanList = [
            'Muntilan', 'Kaliangkrik', 'Mungkid', 'Grabag', 'Windusari',
            'Kajoran', 'Bandongan', 'Ngablak', 'Salaman', 'Mertoyudan',
            'Srumbung', 'Dukun', 'Sawangan', 'Tegalrejo', 'Pakis',
            'Candimulyo', 'Salam', 'Tempuran', 'Borobudur',
            'Ngluwar', 'Secang'
        ];

        echo "=== CAMAT ===\n";

        foreach ($kecamatanList as $kecamatan) {
            $password = Str::random(10);

            User::create([
                'name' => 'Camat ' . $kecamatan,
                'email' => 'camat_' . Str::slug($kecamatan) . '@magelang.go.id',
                'password' => Hash::make($password),
                'role' => 'camat',
                'kecamatan' => $kecamatan,
                'wilayah' => null,
                'must_change_password' => true,
            ]);

            echo "Camat {$kecamatan}\n";
            echo "Email    : camat_" . Str::slug($kecamatan) . "@magelang.go.id\n";
            echo "Password : {$password}\n\n";
        }

        /*
        |--------------------------------------------------------------------------
        | LURAH (5)
        |--------------------------------------------------------------------------
        */
        $kelurahanList = [
            ['nama' => 'Sumberrejo', 'kecamatan' => 'Mertoyudan'],
            ['nama' => 'Sawitan', 'kecamatan' => 'Mungkid'],
            ['nama' => 'Muntilan', 'kecamatan' => 'Muntilan'],
            ['nama' => 'Secang', 'kecamatan' => 'Secang'],
            ['nama' => 'Mendut', 'kecamatan' => 'Mungkid'],
        ];

        echo "=== LURAH ===\n";

        foreach ($kelurahanList as $kel) {
            $password = Str::random(10);

            User::create([
                'name' => 'Lurah ' . $kel['nama'],
                'email' => 'lurah_' . Str::slug($kel['nama']) . '@magelang.go.id',
                'password' => Hash::make($password),
                'role' => 'lurah',
                'kecamatan' => $kel['kecamatan'],
                'wilayah' => $kel['nama'],
                'must_change_password' => true,
            ]);

            echo "Lurah {$kel['nama']} ({$kel['kecamatan']})\n";
            echo "Email    : lurah_" . Str::slug($kel['nama']) . "@magelang.go.id\n";
            echo "Password : {$password}\n\n";
        }

        echo "=== SEEDING SELESAI ===\n";
    }
}
