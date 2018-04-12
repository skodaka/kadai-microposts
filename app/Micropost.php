<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function users_with_favorite()
    {
        return $this->belongsToMany(User::class, 'micropost_favorite', 'micropost_id', 'user_id')->withTimestamps();        
    }
    
    public function add_favorite($userId)
    {
        $exist = $this->is_favorite($userId);
        if ($exist) {
            return false;
        } else {
            $this->users_with_favorite()->attach($userId);
            return true;
        }
    }

    public function delete_favorite($userId)
    {
        $exist = $this->is_favorite($userId);
        if ($exist) {
                        $this->users_with_favorite()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    public function is_favorite($userId)
    {
        return $this->users_with_favorite()->where('users.id', $userId)->exists();
    }
}
