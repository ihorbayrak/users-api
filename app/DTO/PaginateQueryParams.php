<?php

namespace App\DTO;

class PaginateQueryParams
{
    public function __construct(public readonly int $count, public readonly int $offset, public readonly ?int $page)
    {
    }
}
