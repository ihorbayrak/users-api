<?php

namespace App\Services\UserService;

use App\DTO\PaginateQueryParams;
use App\Models\User;
use App\Services\UserService\Exceptions\IncorrectUserIdException;
use App\Services\UserService\Exceptions\UserNotFoundException;

class UserService
{
    public function list(PaginateQueryParams $dto)
    {
        $users = User::query()->latest();

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
}
