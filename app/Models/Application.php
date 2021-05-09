<?php

namespace App\Models;

use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Application extends Model
{
    use HasFactory, CamelCasing, Notifiable;
    protected $guarded = [];
    protected $hidden = ['updated_at'];


    public function contestants()
    {
        return $this->hasMany(Contestant::class);
    }

    public function status()
    {
        return $this->belongsTo(ApplicationStatus::class);
    }

    public function files()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function educationalInstitution()
    {
        return $this->belongsTo(EducationalInstitution::class);
    }
}
