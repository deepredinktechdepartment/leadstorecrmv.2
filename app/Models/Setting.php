<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Specify the table associated with the model
    protected $table = 'settings';

    // Specify the primary key for the model
    protected $primaryKey = 'id';

    // Define fillable attributes
    protected $fillable = [
        'client_id',
        'type',
        'form_data',
    ];

    // Define the type casting for the datetime fields
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
