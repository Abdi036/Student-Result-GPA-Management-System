<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'credits'];

    // A course has many scores
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}