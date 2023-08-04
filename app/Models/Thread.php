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
}
