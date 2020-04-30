<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Driver extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'drivers';

    protected $appends = [
        'driving_licence_certificate',
    ];

    const TYPE_SELECT = [
        '1' => 'Permanent',
        '2' => 'Casual',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone_number',
        'type',
        'drivng_licence_validity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function driverDriverAllocations()
    {
        return $this->hasMany(DriverAllocation::class, 'driver_id', 'id');

    }

    public function getDrivingLicenceCertificateAttribute()
    {
        return $this->getMedia('driving_licence_certificate');

    }
}
