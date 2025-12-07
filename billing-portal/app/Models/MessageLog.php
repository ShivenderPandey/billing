<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
     use HasFactory;

    protected $fillable = [
        'website_id',
        'user_id',
        'provider',
        'template_name',
        'status',
        'provider_message_id',
        'response',
    ];

    protected $casts = [
        'response' => 'array', // automatically json_decode / json_encode
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

