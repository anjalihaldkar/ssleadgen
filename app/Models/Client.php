<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'dob', 'address',
        'status', 'lead_source_id', 'user_id', 'notes',
        'policy_no', 'company', 'login_date', 'anp',
        'suburb', 'city', 'post_code', 'adviser', 'not_counting',
        'compliance_by', 'roa_due_date', 'status_compliance',
        'sent_to_client', 'outcome',
    ];

    protected $casts = [
        'dob' => 'date',
        'login_date' => 'date',
        'roa_due_date' => 'date',
        'not_counting' => 'boolean',
    ];

    public function scopeLoginClients($query)
    {
        return $query->where('status', 'Login Client');
    }

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
