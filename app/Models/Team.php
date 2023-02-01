<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'hero_1',
        'hero_2',
        'hero_3',
        'hero_4',
        'hero_5',
        'hero_6',
    ];

    function user() {
        return $this->hasOne(User::class);
    }
}
