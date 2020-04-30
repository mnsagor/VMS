<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class DriverAllocation extends Model
{
    use SoftDeletes;

    public $table = 'driver_allocations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'driver_id',
        'ragistration_number_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');

    }

    public function ragistration_number()
    {
        return $this->belongsTo(Vehicle::class, 'ragistration_number_id');

    }
}
