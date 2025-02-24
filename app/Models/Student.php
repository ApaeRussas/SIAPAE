<?php

namespace App\Models;

use App\Events\StudentCreated;
use App\Events\StudentUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $state = 'students';
    protected $fillable = [
        'name',
        'date_of_birth',
        'diagnostic',
        'student_id',
        'school',
        'class_school',
        'turn_school',
        'grade_school',
        'class_apae',
        'turn_apae',
        'service',
        'image',
        'state_student',
    ];
    
    protected $dispatchesEvents = [ 
        'created' => StudentCreated::class,
        'updated' => StudentUpdated::class, 
    ];
    
    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'student_id');
    }
    public function educationals(): HasMany
    {
        return $this->hasMany(Educational::class, 'student_id');
    }
    public function frequencies(): HasMany
    {
        return $this->hasMany(Frequency::class, 'student_id');
    }
    public function medHistory(): BelongsTo
    {
        return $this->belongsTo(MedHistory::class, 'student_id');
    }
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
