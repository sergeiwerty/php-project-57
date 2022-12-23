<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    public function creator(): void
    {
        $this->belongsTo(User::class, 'creator_id');
    }

    public function performer(): void
    {
        $this->belongsTo(User::class, 'performer_id');
    }

    public function status(): void
    {
        $this->belongsTo(TaskStatus::class, 'status_id');
    }
}
