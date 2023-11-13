<?php

namespace Database\Seeders;

use App\Models\VoteType;
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
