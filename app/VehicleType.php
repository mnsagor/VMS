<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class VehicleType extends Model
{
    use SoftDeletes;

    public $table = 'vehicle_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function vehicleTypeVehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id', 'id');

    }

    public function vehicleTypeRequisitionRequests()
    {
        return $this->hasMany(RequisitionRequest::class, 'vehicle_type_id', 'id');

    }
}
