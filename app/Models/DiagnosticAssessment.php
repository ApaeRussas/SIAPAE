<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiagnosticAssessment extends Model
{
    use HasFactory;

    protected $table = 'diagnostic_assessments';

    protected $fillable = [
        'student_id',
        'age',
        'series',
        'school',
        'cid',
        'date',
        'language',
        'logical_mathematical',
        'functional_life',
        'body_experience',
        'nature_society',
        'educational_informatics',
        'cognitive',
    ];

    protected $casts = [
        'date' => 'date',

        'language' => 'array',
        'logical_mathematical' => 'array',
        'functional_life' => 'array',
        'body_experience' => 'array',
        'nature_society' => 'array',
        'educational_informatics' => 'array',
        'cognitive' => 'array',
    ];

    /**
     * Aluno relacionado à sondagem.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}