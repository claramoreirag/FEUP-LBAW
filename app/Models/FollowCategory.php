<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class FollowCategory extends Model
{
    use HasFactory;
    protected $primaryKey = ['user_id', 'category_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'follow_category';


    
    //protected $fillable = ['name'];

    protected $casts = [
        'user_id' => 'integer',
        'category_id' => 'integer'
    ];

//     /**
//  * Set the keys for a save update query.
//  *
//  * @param  \Illuminate\Database\Eloquent\Builder  $query
//  * @return \Illuminate\Database\Eloquent\Builder
//  */
// protected function setKeysForSaveQuery(Builder $query)
// {
//     $keys = $this->getKeyName();
//     if(!is_array($keys)){
//         return parent::setKeysForSaveQuery($query);
//     }

//     foreach($keys as $keyName){
//         $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
//     }

//     return $query;
// }

/**
 * Get the primary key value for a save query.
 *
 * @param mixed $keyName
 * @return mixed
 */
protected function getKeyForSaveQuery($keyName = null)
{
    if(is_null($keyName)){
        $keyName = $this->getKeyName();
    }

    if (isset($this->original[$keyName])) {
        return $this->original[$keyName];
    }

    return $this->getAttribute($keyName);
}
    
}
