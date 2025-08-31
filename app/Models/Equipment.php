<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'equipment';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'equipment_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'string';

    /**
     * Use equipment_id for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'equipment_id';
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'equipment_id',
        'facility_id',
        'name',
        'capabilities',
        'description',
        'inventory_code',
        'usage_domain',
        'support_phase',
    ];

    /**
     * Get the facility that owns the equipment.
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
