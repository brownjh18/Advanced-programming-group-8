<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programs';

    protected $primaryKey = 'program_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'program_id',
        'name',
        'description',
        'national_alignment',
        'focus_areas',
        'phases',
    ];

    /**
     * Get the projects for the program.
     */
    // public function projects()
    // {
    //     return $this->hasMany(Project::class, 'ProgramId');
    // }
}