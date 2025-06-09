<?php

namespace Database\Seeders;

use App\Models\Singer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SingerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $singersData = [
            ['id' => 'P001', 'singer_name' => 'TAYLOR SWIFT', 'gender' => 'P', 'awards_count' => 12, 'country' => 'USA'],
            ['id' => 'P002', 'singer_name' => 'BTS', 'gender' => 'L', 'awards_count' => 15, 'country' => 'KOR'],
            ['id' => 'P003', 'singer_name' => 'ED SHEERAN', 'gender' => 'L', 'awards_count' => 10, 'country' => 'UK'],
            ['id' => 'P004', 'singer_name' => 'RIHANNA', 'gender' => 'P', 'awards_count' => 8, 'country' => 'BAR'],
            ['id' => 'P005', 'singer_name' => 'IU', 'gender' => 'P', 'awards_count' => 6, 'country' => 'KOR'],
            ['id' => 'P006', 'singer_name' => 'JUSTIN BIEBER', 'gender' => 'L', 'awards_count' => 9, 'country' => 'CAN'],
            ['id' => 'P007', 'singer_name' => 'AGNES MONICA', 'gender' => 'P', 'awards_count' => 5, 'country' => 'INA'],
            ['id' => 'P008', 'singer_name' => 'GLENN FREDLY', 'gender' => 'L', 'awards_count' => 4, 'country' => 'INA'],
            ['id' => 'P009', 'singer_name' => 'ADELE', 'gender' => 'P', 'awards_count' => 11, 'country' => 'UK'],
            ['id' => 'P010', 'singer_name' => 'BILLIE EILISH', 'gender' => 'P', 'awards_count' => 13, 'country' => 'USA'],
            ['id' => 'P011', 'singer_name' => 'CHARLIE PUTH', 'gender' => 'L', 'awards_count' => 6, 'country' => 'USA'],
            ['id' => 'P012', 'singer_name' => 'RAISA', 'gender' => 'P', 'awards_count' => 4, 'country' => 'INA'],
        ];

        foreach ($singersData as $data) {
            Singer::create($data);
        }
    }
}
