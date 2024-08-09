<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class ImageDimension implements Rule
{
    protected $maxHeight;

    public function __construct($maxHeight)
    {
        $this->maxHeight = $maxHeight;
    }

    public function passes($attribute, $value)
    {
        if ($value->isValid()) {
            $image = Image::make($value->getRealPath());
            return $image->height() < $this->maxHeight;
        }
        return false;
    }

    public function message()
    {
        return 'The :attribute height must be less than ' . $this->maxHeight . ' pixels.';
    }
}
