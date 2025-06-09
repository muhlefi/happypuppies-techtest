<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Song extends Model
{
    use HasFactory;
    protected $table = 'songs';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'song_title',
        'genre',
        'singer_id',
        'spotify_streams',
    ];

    public function singer(): BelongsTo
    {
        return $this->belongsTo(Singer::class, 'singer_id', 'id');
    }
}
