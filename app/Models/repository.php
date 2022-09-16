<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repository extends Model
{
    use HasFactory;
    protected $table = 'repository';
    protected $guarded = ['id'];
    // public function author()
    // {
    //     return $this->belongsTo(author::class);
    // }
    public function type()
    {
        return $this->belongsTo(type::class);
    }
    public function prodi()
    {
        return $this->belongsTo(prodi::class);
    }
}
