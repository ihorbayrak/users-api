<?php

namespace App\Http\Requests;

use App\Enum\FileExtension;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreateUserRequest extends BaseRequest
{
    public function rules(): array
    {
        $jpg = FileExtension::JPG->value;
        $jpeg = FileExtension::JPEG->value;

        return [
            'name' => ['required', 'string', 'min:2', 'max:'.User::MAX_NAME_LENGTH],
            'email' => ['required', 'string', 'email:rfc,dns', 'min:2', 'max:'.User::MAX_EMAIL_LENGTH],
            'phone' => ['required', 'string', 'regex:^[\+]{0,1}380([0-9]{9})$^'],
            'position_id' => ['required', 'integer', 'min:1', Rule::exists('positions', 'id')],
            'photo' => [
                'required',
                "mimes:{$jpg},{$jpeg}",
                File::image()
                    ->max(5 * 1024)
                    ->dimensions(
                        Rule::dimensions()->minHeight(User::PHOTO_HEIGHT)->minWidth(User::PHOTO_WIDTH)
                    ),
            ],
        ];
    }
}
