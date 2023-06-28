<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public const NEW_TASK = 1;
    public const IN_PROGRESS = 2;
    public const COMPLETE = 3;
    public const DELETE = 4;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
