<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDocument extends Model
{
    use HasFactory;

    protected $table = 'student_documents';

    protected $fillable = [
        'student_id',
        'uploaded_by',
        'document_type',
        'title',
        'description',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
    ];

    /**
     * Estudante ao qual o documento pertence.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Usuário que enviou o documento.
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
