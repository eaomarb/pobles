<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function municipis()
    {
        return $this->hasMany(Municipi::class, 'provincia', 'nom');
    }
}
