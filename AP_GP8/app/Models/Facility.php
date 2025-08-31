<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'partner_organization',
        'facility_type',
        'capabilities',
    ];


    /**
     * A facility can have many services.
     */
    // public function services()
    // {
    //     return $this ->hasMany(Services::class);
    // }


     /**
     * A facility can have many pieces of equipment.
     */
    // public function equipment()
    // {
    //     return $this->hasMany(Equipment::class);
    // }

    /**
     * A facility can host many projects.
     */
    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }
}

