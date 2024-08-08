<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'user_types';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id'; // Change 'id' to your primary key if different

    // Define the fillable attributes
    protected $fillable = ['name', 'is_active']; // Add your table's columns here

    // If you don't use timestamps, you can disable them
    public $timestamps = false;

    // If you use a different date format, you can define it here
    // protected $dateFormat = 'U'; // Unix timestamp

    // If you want to cast attributes to different types, you can define casts
    // protected $casts = [
    //     'is_active' => 'boolean',
    // ];
}
