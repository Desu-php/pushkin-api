<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'age_group_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }
}
