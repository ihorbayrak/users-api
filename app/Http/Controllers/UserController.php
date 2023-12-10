<?php

namespace App\Http\Controllers;

use App\DTO\CreateUserData;
use App\DTO\PaginateQueryParams;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UsersListRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersCollection;
use App\Services\UserService\UserService;

class UserController extends ResponseController
{
    public function __construct(private UserService $userService)
    {
    }

    public function index(UsersListRequest $request)
    {
        $users = $this->userService->list(
            new PaginateQueryParams(
                count: $request->getCount(),
                offset: $request->getOffset(),
                page: $request->getPage()
            )
        );

        return $this->responseOk([
            new UsersCollection($users)
        ]);
    }

    public function show($userId)
    {
        $user = $this->userService->specific($userId);

        return $this->responseOk([
            'user' => new UserResource($user)
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userService->create(
            new CreateUserData(
                name: $request->get('name'),
                email: $request->get('email'),
                phone: $request->get('phone'),
                position_id: $request->get('position_id'),
                photo: $request->file('photo')
            )
        );

        return $this->responseCreated([
            "user_id" => $user->id,
            "message" => "New user successfully registered"
        ]);
    }
}
