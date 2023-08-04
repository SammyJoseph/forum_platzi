<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class); // una pregunta pertenece a una categoria
    }

    public function user()
    {
        return $this->belongsTo(User::class); // una pregunta pertenece a un usuario
    }

    public function replies()
    {
        return $this->hasMany(Reply::class); // una pregunta tiene muchas respuestas
    }
}
