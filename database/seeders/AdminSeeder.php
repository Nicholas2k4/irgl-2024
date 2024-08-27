<?php

namespace Database\Seeders;

use App\Models\Admin;
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
            // IT
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
            ],

            // BPH
            [
                'id'=> Str::uuid(),
                'name' => 'Maximillanus Grego S',
                'email' => 'c14220014@john.petra.ac.id',
                'division_name' => 'BPH'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Alexander Yofilio S',
                'email' => 'c14220071@john.petra.ac.id',
                'division_name' => 'BPH'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Cathlyn Angeline',
                'email' => 'c14220133@john.petra.ac.id',
                'division_name' => 'BPH'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Laura Wijaya Dinata',
                'email' => 'c14220192@john.petra.ac.id',
                'division_name' => 'BPH'
            ],

            // Pubsek
            [
                'id'=> Str::uuid(),
                'name' => 'Joyce Angelica',
                'email' => 'c14220163@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Fernando Hose',
                'email' => 'c14220151@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Sharon Valerina Tannus',
                'email' => 'c14230048@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Axel Valent',
                'email' => 'c14230145@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Natasya Yobel',
                'email' => 'c14230151@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Aloysia Jennifer Harijadi',
                'email' => 'c14230191@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
            [
                'id'=> Str::uuid(),
                'name' => 'Matthew Benedict',
                'email' => 'c14230234@john.petra.ac.id',
                'division_name' => 'pubsek'
            ],
        ]; 
            foreach($admins as $admin){
                Admin::create($admin);
            }
     }
}
