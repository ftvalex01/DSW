<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'trusted',
    ];
    static $rules=[
        'name',
        'email',
        'password',
        'trusted',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function isTrusted()
    {

        return $this->trusted;
    }
    function votes()
    {
        return $this->belongsToMany(CommunityLink::class, "community_link_users")->withTimestamps();
    }
   
    public function votedFor(CommunityLink $link)
    {
        return $this->votes->contains($link);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
