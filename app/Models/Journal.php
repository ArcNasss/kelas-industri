<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $keyType = 'char';

    protected $table = 'journals';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $fillable = ['id','title', 'date', 'description','classroom_id', 'created_by'];


    public function classroom():BelongsTo
    {
        return $this->belongsTo(classroom::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'created_by');
    }

}
