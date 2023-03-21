<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentSchool extends Model
{
    use HasFactory;

    protected $fillable = ['school_id', 'student_id'];

    /**
     * many to one relationship
     *
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * one to many relationship
     *
     * @return HasMany
     */
    public function classrooms(): HasMany
    {
        return $this->hasMany(StudentClassroom::class);
    }
}
