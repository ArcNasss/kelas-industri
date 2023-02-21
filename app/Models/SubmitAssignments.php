<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitAssignments extends Model
{
    use HasFactory;

    protected $fillable = ['sub_material_id', 'student_id', 'file'];
}
