<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommunityLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'link',
        'approved',
        
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
   
    public function users()
    {
    return $this->belongsToMany(User::class, 'community_link_users');
    }

  /*   public function toArray()
    {
        return [
            'channel_id' => $this->channel_id,
            'title' => $this->title,
            'link' => $this->link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
     */
   

    public static function hasAlreadyBeenSubmitted($link)
    {
        if ($existing = static::where('link', $link)->first()) {
            if (Auth::user()->isTrusted() || !Auth::user()->isTrusted() && $existing['approved'] == 0) {
                $existing->touch();
                $existing->save();
            }
            return true;
        }
        return false;
    }
    
}
