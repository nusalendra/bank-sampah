<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => Str::random(10),
            'password' => Hash::make('password'),
            'jenis_kelamin' => Str::random(10),
            'nomor_telephone' => Str::random(10),
            'foto_profil' => Str::random(10),
            'role' => 'Nasabah',
        ]);

        DB::table('nasabahs')->insert([
            'user_id' => 1,
            'nomor_register' => Str::random(10),
            'nomor_kartu_keluarga' => Hash::make('password'),
            'saldo_aktual' => null,
            'saldo_sementara' => null,
            'status' => 'Aktif',
        ]);

        DB::table('sampahs')->insert([
            'nama' => Str::random(10),
            'jenis' => Str::random(10),
            'harga_per_kg' => 25000,
        ]);

        DB::table('sampahs')->insert([
            'nama' => Str::random(10),
            'jenis' => Str::random(10),
            'harga_per_kg' => 10000,
        ]);

        DB::table('setor_sampahs')->insert([
            'user_id' => 1,
            'tanggal' => date('Y-m-d', rand(strtotime('-1 year'), time())),
            'bukti_setor' => Str::random(10),
            'status' => 'Proses',
        ]);
    }
}
