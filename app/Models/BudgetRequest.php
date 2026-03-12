<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact',
        'intent',
        'message',
        'project_type',
        'description',
        'deadline',
        'budget',
        'status',
        'source',
    ];
}
