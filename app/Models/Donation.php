<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $state = 'donations';
    
    protected $fillable = [
        'student_id',
        'Jan',
        'Fev',
        'Mar',
        'Abr',
        'Mai',
        'Jun',
        'Jul',
        'Ago',
        'Set',
        'Out',
        'Nov',
        'Dez',
        'year_of_donation',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id'); 
    }
}
