<?php

namespace App\Http\Requests;

class UsersListRequest extends BaseRequest
{
    protected const DEFAULT_COUNT = 5;
    protected const DEFAULT_OFFSET = 0;
    protected const MAX_RESULT = 100;

    public function rules(): array
    {
        return [
            'count' => ['sometimes', 'integer', 'min:1', 'max:'.static::MAX_RESULT],
            'offset' => ['sometimes', 'integer', 'min:0'],
            'page' => ['sometimes', 'integer', 'min:1']
        ];
    }

    public function getCount(): int
    {
        return $this->get('count', static::DEFAULT_COUNT);
    }

    public function getOffset(): int
    {
        return $this->get('offset', static::DEFAULT_OFFSET);
    }

    public function getPage(): int|null
    {
        return $this->get('page');
    }
}
