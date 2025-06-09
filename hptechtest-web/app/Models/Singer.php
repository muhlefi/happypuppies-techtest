<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Singer extends Model
{
    use HasFactory;
    protected $table = 'singers';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'singer_name',
        'gender',
        'awards_count',
        'country',
    ];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class, 'singer_id', 'id');
    }
}
