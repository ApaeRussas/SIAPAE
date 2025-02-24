<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regional extends Model
{
    use HasFactory;
    protected $state = 'regionals';
    protected $fillable = [
        'title',
        'subtitle',
        'text',
        'signature_id',
        'date',
    ];

    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signature_id');
    }
}
