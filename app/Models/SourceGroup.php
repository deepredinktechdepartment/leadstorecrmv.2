<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceGroup extends Model
{
    use HasFactory;

    protected $table = 'source_group';

    protected $fillable = [
        'source_icon',
        'name'
    ];

    public function sources()
    {
        return $this->hasMany(Source::class, 'source_group_id');
    }
}
