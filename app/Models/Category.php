<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'category';

    
    protected $fillable = ['name'];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function name(){
        return 'name';
    }
}
