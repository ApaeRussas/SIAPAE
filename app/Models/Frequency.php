<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Frequency extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'student_id',
        'class_apae',    
        'turn_apae', 
        'month_year', 
        'observation', 
        'signature_id',
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31' 
    ];

    protected $casts = [
        '1' => 'boolean', '2' => 'boolean', '3' => 'boolean', '4' => 'boolean', '5' => 'boolean', '6' => 'boolean', '7' => 'boolean', '8' => 'boolean', '9' => 'boolean', '10' => 'boolean', '11' => 'boolean', '12' => 'boolean', '13' => 'boolean', '14' => 'boolean', '15' => 'boolean', '16' => 'boolean', '17' => 'boolean', '18' => 'boolean', '19' => 'boolean', '20' => 'boolean', '21' => 'boolean', '22' => 'boolean', '23' => 'boolean', '24' => 'boolean', '25' => 'boolean', '26' => 'boolean', '27' => 'boolean', '28' => 'boolean', '29' => 'boolean', '30' => 'boolean', '31' => 'boolean',
    ];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function professor(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
