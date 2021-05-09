<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'has_multiple_contestants', 'is_active', 'has_video'];

    protected $hidden = ['created_at', 'updated_at'];

    public function ageGroups()
    {
        return $this->hasMany(AgeGroup::class);
    }

}
