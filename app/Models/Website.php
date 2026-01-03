<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
     use HasFactory;

    // Which columns can be mass-assigned (Website::create([...]))
    protected $fillable = [
        'user_id',
        'name',
        'domain',
        'billing_amount',
        'billing_currency',
        'billing_frequency',
        'expiry_date',
        'status',
        'notes',
    ];

    // Casts tell Laravel how to treat certain columns (e.g., as dates)
    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    // Each website belongs to one user
    public function user()
    {
        // App\Models\User class (same namespace, so we don't need "use App\Models\User")
        return $this->belongsTo(User::class);
    }

    // One website has many message logs
    public function messageLogs()
    {
        return $this->hasMany(MessageLog::class);
    }
}

