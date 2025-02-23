<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Voter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'dob', 'mobile', 'email', 'address',
        'taluk', 'district', 'state', 'registration_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($voter) {
            $voter->registration_id = Str::uuid();
        });
    }

    protected $dates = ['dob'];

    public function getDobAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('m/d/Y');
    }
}
