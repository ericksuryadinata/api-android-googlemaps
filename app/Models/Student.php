<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nbi','name','place_of_birth','date_of_birth','phone','address',
        'faculty','major','gender','hoby','nationality',
        'photo','latitude','longitude'
    ];
}
