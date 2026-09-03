<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'dob',
        'address',
        'status',
        'lead_source_id',
        'user_id',
        'notes',
    ];

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
