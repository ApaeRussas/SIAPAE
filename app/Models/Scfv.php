<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scfv extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        '1Q_objective',
        '1Q_activity',
        '1Q_description',
        '1Q_resource',
        '1Q_partner',
        '1Q_date',
        '1Q_place',
        '2Q_objective',
        '2Q_activity',
        '2Q_description',
        '2Q_resource',
        '2Q_partner',
        '2Q_date',
        '2Q_place',
        'students_frequency',
        'signature_id',
        'date_scfv',
    ];

    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signature_id');
    }
}
