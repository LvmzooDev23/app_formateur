<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    protected $table = 'school_classes';
    protected $fillable = ['name'];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
