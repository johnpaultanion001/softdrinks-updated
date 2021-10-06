<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusReturn;

class StatusReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'id'    => '1',
                'code' => 'FCS',
                'title' => 'FULL CASE OF SOFTDRINKS',
                'user_id' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => '2',
                'code' => 'EFCS',
                'title' => 'EMPTY FULL CASE OF SOFTDRINKS',
                'user_id' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => '3',
                'code' => 'MBCS',
                'title' => 'MISSING BOTTLES CASE OF SOFTDRINKS',
                'user_id' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],        
        ];
        StatusReturn::insert($status);
            
    }
}
