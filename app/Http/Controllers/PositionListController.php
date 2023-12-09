<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionListController extends Controller
{
    public function __invoke()
    {
        return PositionResource::collection(Position::all());
    }
}
