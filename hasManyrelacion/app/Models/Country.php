<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class); 
    }
    public function posts()
    {
        return $this->hasManyThrough(
            'App\Models\Post', 
            'App\Models\User', 
            'country_id',      
            'user_id',         
            'id',              
            'id'              
        );
    }
}
