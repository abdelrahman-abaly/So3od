<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description',
        'goal','reps', 'sets',
        'completed_sets','rest',
        'weight','link',
        'created_at', 'updated_at'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'workout_user');
    }
}
