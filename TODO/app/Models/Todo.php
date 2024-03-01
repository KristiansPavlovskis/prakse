<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'description', 'is_completed', 'user_id','group_id', 'priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function sharedUsers()
{
    return $this->belongsToMany(User::class, 'todo_user');
}
public function users()
{
    return $this->belongsToMany(User::class);
}


}

