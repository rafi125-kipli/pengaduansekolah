<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';
    public $incrementing = true;
    protected $fillable = [
        'ket_kategori',
    ];

    public function inputAspirasis()
    {
        return $this->hasMany(InputAspirasi::class, 'id_kategori', 'id_kategori');
    }

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori', 'id_kategori');
    }
}
