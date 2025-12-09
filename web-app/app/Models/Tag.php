<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    public function feedbacks()
    {
        return $this->belongsToMany(Feedback::class);
    }
}
