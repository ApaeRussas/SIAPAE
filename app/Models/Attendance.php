<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $casts = [
        'activity_not_performed' => 'boolean',
        'advances_level' => 'integer',
        'difficulties_level' => 'integer',
    ];

    protected $fillable = [
        'student_id',
        'date',
        'educational_axis',

        'skills',
        'skills_evolution',

        'advances',
        'advances_level',

        'difficulties',
        'difficulties_level',

        'activity_description',
        'activity_not_performed',
        'signature_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signature_id');
    }
}