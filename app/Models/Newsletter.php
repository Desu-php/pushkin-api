<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'contestant_id',
        'status_id'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function status()
    {
        return $this->belongsTo(NewsletterStatus::class);
    }

    public function contestant()
    {
        return $this->belongsTo(Contestant::class);
    }
}
