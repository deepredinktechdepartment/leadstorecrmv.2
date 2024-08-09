<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use HasFactory;

    public function scopeMappedToUser($query)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Check if the user exists and has mapped projects
        if ($user && !empty($user->projects_mapped)) {
            // Check if the projects_mapped field is a valid JSON string
            $mappedProjects = json_decode($user->projects_mapped, true);

            // Only proceed if json_decode was successful and the result is an array
            if (json_last_error() === JSON_ERROR_NONE && is_array($mappedProjects)) {
                // Filter the query based on the mapped projects
                return $query->whereIn('id', $mappedProjects);
            }
        }

        // Return an empty query if no valid JSON data or no projects mapped
        return $query->whereRaw('1 = 0');
    }

}
