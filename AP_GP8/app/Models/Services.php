<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'services';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'service_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'service_id',
        'facility_id',
        'name',
        'description',
        'category',
        'skill_type',
    ];

    /**
     * Use service_id for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'service_id';
    }

    /**
     * Get the facility that offers this service.
     */
    public function facility()
    {
        // facility_id is the foreign key on services table; id is the primary key on facilities table
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
