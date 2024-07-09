<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example users data
        $users = [
            [
                'nama' => 'John Doe',
                'tanggal_lahir' => '1990-01-01',
                'tempat_lahir' => 'Jakarta',
                'alamat' => 'Jl. Raya No. 123',
                'kode_pos' => '12345',
                'no_telp' => '08123456789',
                'id_line' => 'john_doe_line',
                'link_foto' => 'https://example.com/john_doe.jpg',
                'is_ketua' => true,
                'bank' => 'BCA',
                'no_rek' => '1234567890',
                'id_tim' => Team::where('nama', 'Team A')->first()->id,
            ],
            [
                'nama' => 'Jane Doe',
                'tanggal_lahir' => '1992-03-15',
                'tempat_lahir' => 'Surabaya',
                'alamat' => 'Jl. Mawar No. 456',
                'kode_pos' => '54321',
                'no_telp' => '0876543210',
                'id_line' => 'jane_doe_line',
                'link_foto' => 'https://example.com/jane_doe.jpg',
                'is_ketua' => false,
                'bank' => 'BNI',
                'no_rek' => '0987654321',
                'id_tim' => Team::where('nama', 'Team A')->first()->id,
            ],
            // Add more users as needed
        ];

        // Insert data into the database
        foreach ($users as $user) {
            User::create([
                'nama' => $user['nama'],
                'tanggal_lahir' => $user['tanggal_lahir'],
                'tempat_lahir' => $user['tempat_lahir'],
                'alamat' => $user['alamat'],
                'kode_pos' => $user['kode_pos'],
                'no_telp' => $user['no_telp'],
                'id_line' => $user['id_line'],
                'link_foto' => $user['link_foto'],
                'is_ketua' => $user['is_ketua'],
                'bank' => $user['bank'],
                'no_rek' => $user['no_rek'],
                'id_tim' => $user['id_tim'],
            ]);
        }
    }
}
