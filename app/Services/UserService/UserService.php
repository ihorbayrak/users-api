<?php

namespace App\Services\UserService;

use App\DTO\CreateUserData;
use App\DTO\PaginateQueryParams;
use App\Models\User;
use App\Services\UserService\Actions\StorePhotoAction;
use App\Services\UserService\Exceptions\EmailAlreadyExistsException;
use App\Services\UserService\Exceptions\IncorrectUserIdException;
use App\Services\UserService\Exceptions\PhoneAlreadyExistsException;
use App\Services\UserService\Exceptions\UserNotFoundException;

class UserService
{
    public function __construct(private StorePhotoAction $storePhoto)
    {
    }

    public function list(PaginateQueryParams $dto)
    {
        $users = User::query()->with(['position'])->latest();

        $page = $dto->page ?? (int)floor($dto->offset / $dto->count) + 1;

        return $users->paginate(perPage: $dto->count, page: $page);
    }

    public function specific($userId)
    {
        if (!ctype_digit($userId)) {
            throw new IncorrectUserIdException([
                'fails' => [
                    'user_id' => 'The user_id must be an integer.'
                ]
            ]);
        }

        $user = User::find($userId);

        if (!$user) {
            throw new UserNotFoundException([
                'fails' => [
                    'user_id' => 'User not found'
                ]
            ]);
        }

        return $user;
    }

    public function create(CreateUserData $dto)
    {
        $emailExists = User::where('email', $dto->email)->first();

        if ($emailExists) {
            throw new EmailAlreadyExistsException();
        }

        $phoneExists = User::where('phone', $dto->phone)->first();

        if ($phoneExists) {
            throw new PhoneAlreadyExistsException();
        }

        $name = ucwords(strtolower($dto->name));
        $photo = $this->storePhoto->handle($dto->photo, User::PHOTOS_FOLDER);

        return User::create([
            'name' => $name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'position_id' => $dto->position_id,
            'photo' => $photo
        ]);
    }
}
