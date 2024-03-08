<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteEvent extends Model
{
    use HasFactory;

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
