<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'projects';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'project_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'string';

    /**
     * Use project_id for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'project_id';
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'project_id',
        'program_id',
        'facility_id',
        'title',
        'nature_of_project',
        'description',
        'innovation_focus',
        'prototype_stage',
        'testing_requirements',
        'commercialization_plan',
    ];

    /**
     * Get the program that owns the project.
     */
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    /**
     * Get the facility that hosts the project.
     */
    // public function facility()
    // {
    //     return $this->belongsTo(Facility::class, 'facility_id', 'facility_id');
    // }

    /**
     * Get the participants for the project.
     */
    // public function participants()
    // {
    //     return $this->hasMany(Participant::class, 'project_id', 'project_id');
    // }

    /**
     * Get the outcomes for the project.
     */
    // public function outcomes()
    // {
    //     return $this->hasMany(Outcome::class, 'project_id', 'project_id');
    // }
}
