<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'source';
    protected $fillable = ['name'];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    public function posts(){
        return $this->hasMany('App\Models\PostSource');
    }

    protected function create(array $data)
    {
        return Source::create([
            'name' => $data['name'],
        ]);
    }
}
