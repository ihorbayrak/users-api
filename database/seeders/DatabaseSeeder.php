<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        File::deleteDirectory(public_path('images/'.User::PHOTOS_FOLDER));

        $positions = Position::factory(5)->create();

        User::factory(47)
            ->state(
                new Sequence(fn() => [
                    'position_id' => $positions->random(),
                ])
            )
            ->create();
    }
}
