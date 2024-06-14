<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pets')->insert([
            [

                'pet_name' => 'Ah Luke2',
                'pet_gender_id' => 2,
                'pet_age' => 12,
                'pet_breed' => 1,
                'pet_img' => 'https://firebasestorage.googleapis.com/v0/b/fir-yourwoof.appspot.com/o/images%2Fpet7.jpeg-1716139075820-0.1408112260102239?alt=media&token=fc206976-ca08-4b57-bbf7-fbd66e5279b1', // Use null if pet_img should be NULL in database
                'pet_description' => 'Cute',
                'pet_status' => 'Vaccinated',
                'pet_cate_id' => 1,
                'created_at' => '2024-04-30 09:35:20',
                'updated_at' => '2024-04-30 09:35:32'
            ],

        ]);
    }
}
