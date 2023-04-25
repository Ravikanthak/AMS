<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_type = [
            [
                'user_type' => 1,
                'user_type_sub_cat' => '1_1',
                'name' => 'Super Admin',
            ],
            //////
            [
                'user_type' => 2,
                'user_type_sub_cat' => '2_1',
                'name' => 'Establishment Admin',
            ],
            [
                'user_type' => 2,
                'user_type_sub_cat' => '2_2',
                'name' => 'Establishment Head',
            ],
            [
                'user_type' => 2,
                'user_type_sub_cat' => '2_3',
                'name' => 'Establishment Subject Clerk',
            ],
            //////
            [
                'user_type' => 3,
                'user_type_sub_cat' => '3_1',
                'name' => 'Bde Admin',
            ],
            [
                'user_type' => 3,
                'user_type_sub_cat' => '3_2',
                'name' => 'Bde Comd',
            ],
            [
                'user_type' => 3,
                'user_type_sub_cat' => '3_3',
                'name' => 'BM',
            ],
            //////
            [
                'user_type' => 4,
                'user_type_sub_cat' => '4_1',
                'name' => 'Div Admin',
            ],
            [
                'user_type' => 4,
                'user_type_sub_cat' => '4_2',
                'name' => 'Div Comd',
            ],
            [
                'user_type' => 4,
                'user_type_sub_cat' => '4_3',
                'name' => 'Col GS',
            ], 
            //////
            [
                'user_type' => 5,
                'user_type_sub_cat' => '5_1',
                'name' => 'SFHQ Admin',
            ], 
            [
                'user_type' => 5,
                'user_type_sub_cat' => '5_2',
                'name' => 'BGS',
            ], 
            [
                'user_type' => 5,
                'user_type_sub_cat' => '5_3',
                'name' => 'Col GS',
            ],
            [
                'user_type' => 5,
                'user_type_sub_cat' => '5_4',
                'name' => 'GSO I',
            ], 
            [
                'user_type' => 5,
                'user_type_sub_cat' => '5_5',
                'name' => 'GSO II',
            ], 
            [
                'user_type' => 5,
                'user_type_sub_cat' => '5_6',
                'name' => 'SFHQ Subject Clerk',
            ],
            //////
            [
                'user_type' => 6,
                'user_type_sub_cat' => '6_1',
                'name' => 'D-Ops Admin',
            ],
            [
                'user_type' => 6,
                'user_type_sub_cat' => '6_2',
                'name' => 'D-Ops Director',
            ],
            [
                'user_type' => 6,
                'user_type_sub_cat' => '6_3',
                'name' => 'D-Ops SO (Special Ops)',
            ],
            [
                'user_type' => 6,
                'user_type_sub_cat' => '6_4',
                'name' => 'D-Ops SO (Coordination Ops)',
            ],
            [
                'user_type' => 6,
                'user_type_sub_cat' => '6_5',
                'name' => 'D-Ops Subject Clerk (Special Ops)',
            ],
            [
                'user_type' => 6,
                'user_type_sub_cat' => '6_6',
                'name' => 'D-Ops Subject Clerk (Coordination Ops)',
            ],
        ];

        foreach ($user_type as $key => $value) {
            UserType::create($value);
        }
    }
}
