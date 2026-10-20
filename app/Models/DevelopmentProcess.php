<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevelopmentProcess extends Model
{
    use HasFactory;

    protected $table = 'development_processes';

    protected $fillable = [
        'student_id',
        'user_id',
        'teacher_id',
        'evaluation_date',
        'responses',
        'observations',
        'family_guidance',
        'teacher_signature',
        'coordination_signature',
    ];

    protected $casts = [
        'evaluation_date' => 'date',
        'responses' => 'array',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}