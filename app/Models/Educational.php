<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Educational extends Model
{
    use HasFactory;
    protected $state = 'educationals';

    protected $fillable = [
        'student_id',
        'school',
        'age',
        'turn_school',
        'grade_school',
        'school_year',
        'professor_signature',
        'text',
        'period',
        'date_pedagogical',
        'signature_id'
    ];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signature_id');
    }
}
