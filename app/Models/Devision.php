<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Devision extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'char';
    protected $table = 'devisions';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name'];

    public function classroom(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }

    /**
     * Get all of the criterias for the Devision
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function criterias(): HasMany
    {
        return $this->hasMany(Criteria::class);
    }
}
