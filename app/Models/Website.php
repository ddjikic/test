<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['external_id', 'name', 'domain', 'user_id'];

    public function scopeUser(Builder $query): void
    {
        $query->where('user_id', \Auth::user()->id);
    }


    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(WebsiteEvent::class);
    }

}
