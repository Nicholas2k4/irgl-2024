<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
        Schema::enableForeignKeyConstraints();
        $admins =[ 
            [
                'id'=> Str::uuid(),
                'name' => 'Kevin Tanaka',
                'email' => 'c14230088@john.petra.ac.id',
                'division_name' => 'IT' 
            ]
        ]; 
            foreach($admins as $admin){
                Admin::create($admin);
            }
     }
}
