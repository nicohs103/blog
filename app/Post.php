<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable = ['title', 'created_by', 'description', 'publication_date'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
