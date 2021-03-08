<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'content'
    ];

    /**
     * 1 message belong to user
     */
    public function fromUser()
    {
        return $this->belongsTo('App\Models\User', 'from', 'id');
    }


    /**
     * 1 message belong to user
     */
    public function toUser()
    {
        return $this->belongsTo('App\Models\User', 'to', 'id');
    } 
}
