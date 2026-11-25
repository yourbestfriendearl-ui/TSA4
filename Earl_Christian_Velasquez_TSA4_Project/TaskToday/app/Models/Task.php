<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'due_date', 'status', 'is_archived'];

    protected function casts(): array
    {
        return ['due_date' => 'date', 'is_archived' => 'boolean'];
    }
}
