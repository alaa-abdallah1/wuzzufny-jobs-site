<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_token',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array',
    ];

    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    // return Skills as Array
    public function getSkillsAttribute($skills)
    {
        return str_word_count($skills, 1);
    }

    public function scopeOrderDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function getAvatarAttribute($avatar)
    {
        return $avatar ? $avatar : 'https://wuzzufny-laravel-site.s3.us-east-2.amazonaws.com/images/profile-pic.jpg';
    }

    // public function setAvatarAttribute($value)
    // {
    //     if (str_contains($value, 'public/storage/images/fake')) {
    //         $path = str_replace('public/storage/images/fake', 'storage/images/fake', $value);
    //     } else if (str_contains($value, 'public/images')) {
    //         $path = str_replace('public/images', 'storage/images', $value);
    //     } else {
    //         $path = $value;
    //     }

    //     $this->attributes['avatar'] = $path;
    // }

}