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
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Nicholas Sindoro',
                'email' => 'c14220142@john.petra.ac.id',
                'division_name' => 'IT'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Charles Wijaya',
                'email' => 'c14220046@john.petra.ac.id',
                'division_name' => 'IT'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Jeffry Hermawan',
                'email' => 'c14220139@john.petra.ac.id',
                'division_name' => 'IT'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Girvan Witartha',
                'email' => 'c14220167@john.petra.ac.id',
                'division_name' => 'IT'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Valerie Patricia Tanlain',
                'email' => 'c14230230@john.petra.ac.id',
                'division_name' => 'IT'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Christopher Joshua',
                'email' => 'c14230260@john.petra.ac.id',
                'division_name' => 'IT'
            ]
        ]; 
            foreach($admins as $admin){
                Admin::create($admin);
            }
     }
}
