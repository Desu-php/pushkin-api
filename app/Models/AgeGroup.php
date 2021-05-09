<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'contest_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function themes()
    {
        return $this->hasMany(Theme::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
