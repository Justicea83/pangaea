<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    private $topics = [
        [
            'name' => 'topic1'
        ],
        [
            'name' => 'topic2'
        ],
        [
            'name' => 'topic3'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->topics as $topic){
            Topic::query()->firstOrCreate($topic);
        }
    }
}
