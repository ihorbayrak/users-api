<?php

namespace Database\Factories;

use App\Models\User;
use App\Services\UserService\Actions\StorePhotoAction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => "+380".mt_rand(100000000, 999999999),
            'photo' => function (array $attributes) {
                $file = UploadedFile::fake()->image('placeholder.jpg', User::PHOTO_WIDTH, User::PHOTO_HEIGHT);

                return app(StorePhotoAction::class)->handle($file, User::PHOTOS_FOLDER);
            },
            'created_at' => $createdAt = fake()->dateTimeThisYear(),
            'updated_at' => fake()->dateTimeBetween($createdAt)
        ];
    }
}
