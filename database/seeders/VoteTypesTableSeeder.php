<?php

namespace Database\Seeders;

use App\Model\VoteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'above',
            'below',
        ];

        foreach($types as $type) {
            VoteType::updateOrCreate(['name' => $type], []);
        }
    }
}
