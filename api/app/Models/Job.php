<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'experience' => 'array',
        'skills' => 'array',
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
        'status',
    ];

    public function getCreatedAtAttribute($date)
    {
        $date = 'dS  M, Y';
        return date($date);
    }

    // return Skills as Array
    public function getSkillsAttribute($skills)
    {
        return json_decode($skills, true);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeOrderDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }

    public function applies()
    {
        return $this->hasMany('App\Models\Apply');
    }

    public function getLogoAttribute($logo)
    {
        return $logo ? $logo : 'https://wuzzufny-laravel-site.s3.us-east-2.amazonaws.com/images/logo.jpg';
    }

    // public function setLogoAttribute($logo)
    // {
    //     if (str_contains($logo, 'public/storage/images/fake')) {
    //         $path = str_replace('public/storage/images/fake', 'storage/images/fake', $logo);
    //     } else if (str_contains($logo, 'public/images/')) {
    //         $path = str_replace('public/images', 'storage/images', $logo);
    //     } else {
    //         $path = $logo;
    //     }
    //     $this->attributes['logo'] = $path;
    // }

}