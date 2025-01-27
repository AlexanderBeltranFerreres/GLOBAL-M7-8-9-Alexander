<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'title', 'description', 'url', 'published_at', 'previous', 'next', 'series_id'
    ];

    protected $dates = ['published_at'];

    public function getFormattedPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->format('DD [de] MM [de] YYYY');
    }

    // Format per exemple "fa 2 hores"
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    //Unix timestamp
    public function getPublishedAtTimestampAttribute()
    {
        return Carbon::parse($this->published_at)->timestamp;
    }

    public function getFormattedPublishedAtDate()
    {
        if ($this->published_at) {
            return $this->published_at->format('d/m/Y H:i');
        }
        return 'No publicat';

    }

}
