<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class VehicleAllocation extends Model
{
    use SoftDeletes;

    public $table = 'vehicle_allocations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'organogram_id',
        'division_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function organogram()
    {
        return $this->belongsTo(Organogram::class, 'organogram_id');

    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');

    }

    public function vehicle_serial_numbers()
    {
        return $this->belongsToMany(Vehicle::class);

    }
}
