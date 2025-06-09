<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = [
            ['id' => 'L001', 'song_title' => 'Love Story', 'genre' => 'Pop', 'singer_id' => 'P001', 'spotify_streams' => 950000000],
            ['id' => 'L002', 'song_title' => 'Dynamite', 'genre' => 'K-Pop', 'singer_id' => 'P002', 'spotify_streams' => 1200000000],
            ['id' => 'L003', 'song_title' => 'Shape of You', 'genre' => 'Pop', 'singer_id' => 'P003', 'spotify_streams' => 1500000000],
            ['id' => 'L004', 'song_title' => 'Umbrella', 'genre' => 'R&B', 'singer_id' => 'P004', 'spotify_streams' => 800000000],
            ['id' => 'L005', 'song_title' => 'Celebrity', 'genre' => 'K-Pop', 'singer_id' => 'P005', 'spotify_streams' => 600000000],
            ['id' => 'L006', 'song_title' => 'Peaches', 'genre' => 'R&B', 'singer_id' => 'P006', 'spotify_streams' => 700000000],
            ['id' => 'L007', 'song_title' => 'Matahariku', 'genre' => 'Pop', 'singer_id' => 'P007', 'spotify_streams' => 500000000],
            ['id' => 'L008', 'song_title' => 'Kasih Putih', 'genre' => 'Pop', 'singer_id' => 'P008', 'spotify_streams' => 300000000],
        ];

        foreach ($songs as $data) {
            Song::create($data);
        }
    }
}
