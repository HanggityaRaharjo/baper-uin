<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    use HasFactory;
    protected $table = 'author';
    protected $guarded = ['id'];
    // public function repository()
    // {
    //     return $this->hasMany(repository::class);
    // }
}
