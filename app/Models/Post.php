<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // permet d'etablir les champs remplissable de la BDD
    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    // permet d'etablir les champs NON remplissable de la BDD
    // protected $guarded = [];
}
