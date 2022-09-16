<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    use HasFactory;
    protected $table = 'prodi';
    protected $guarded = ['id'];
    public function repository()
    {
        return $this->hasMany(repository::class);
    }
}
