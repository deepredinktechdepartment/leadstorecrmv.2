<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class ApiCredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'licence_id',

        'api_key',
        'intranet_project_id',
        'added_by',
        'created_at',
        'updated_at',
    ];



    public static function getValidationRules($id = null)
    {

            $rules = [

            'api_key' => 'required|unique:api_credentials,api_key',
            // ... other validation rules ...
            ];

        if ($id) {
            // If an ID is provided, you're updating an existing record.

           // $rules['api_key'] = 'required|unique:api_credentials,api_key,'.$id;

            $rules = [

                'api_key' => 'required'
                ];
        }

        return $rules;
    }


}
