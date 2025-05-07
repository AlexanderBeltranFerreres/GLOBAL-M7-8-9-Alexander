<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    public $table = 'videos';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'published_at',
        'previous',
        'next',
        'series_id',
        'user_id',
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'series_id');
    }

    /**
     * @var list<string>
     */
    protected $dates = ['published_at'];

    /**
     * Retorna la data de publicació en format "DD de MM de YYYY".
     */
    public function getFormattedPublishedAtAttribute(): string
    {
        return Carbon::parse($this->published_at)->translatedFormat('d [de] F [de] Y');
    }

    /**
     * Retorna l'URL per embeure el vídeo.
     */
    public function getEmbedUrlAttribute(): string
    {
        return str_replace('watch?v=', 'embed/', $this->url);
    }

    /**
     * Retorna la data de publicació en format humà, per exemple "fa 2 hores".
     */
    public function getFormattedForHumansPublishedAtAttribute(): string
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    /**
     * Retorna la data de publicació com a Unix timestamp.
     */
    public function getPublishedAtTimestampAttribute(): int
    {
        return Carbon::parse($this->published_at)->timestamp;
    }

    /**
     * Retorna la data de publicació en format "d/m/Y H:i".
     */
    public function getFormattedPublishedAtDate(): string
    {
        return $this->published_at ? Carbon::parse($this->published_at)->format('d/m/Y H:i') : 'No publicat';
    }

    /**
     * Relació amb el vídeo anterior.
     */
    public function previousVideo(): BelongsTo
    {
        return $this->belongsTo(self::class, 'previous');
    }

    /**
     * Relació amb el vídeo següent.
     */
    public function nextVideo(): BelongsTo
    {
        return $this->belongsTo(self::class, 'next');
    }


}
