<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable = [
        'title', 'description', 'url', 'published_at', 'previous', 'next', 'series_id'
    ];

    protected $dates = ['published_at'];

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->isoFormat('D [de] MMMM [de] YYYY') : null;
    }

    // Format per exemple "fa 2 hores"
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->diffForHumans() : null;
    }

    //Unix timestamp
    public function getPublishedAtTimestampAttribute()
    {
        return $this->published_at ? $this->published_at->timestamp : null;
    }

}
