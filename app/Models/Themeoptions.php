<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveOrgaization;

class Themeoptions extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveOrgaization('themeoptions'));
    }
}
