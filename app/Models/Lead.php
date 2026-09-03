<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'estimated_cover',
        'lead_source_id',
        'status',
        'user_id',
    ];

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
