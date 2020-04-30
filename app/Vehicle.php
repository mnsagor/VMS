<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Vehicle extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'vehicles';

    protected $appends = [
        'fitness_certificate',
        'tex_token_certificate',
        'other_documents',
    ];

    protected $dates = [
        'ragistration_date',
        'fitness_vality',
        'tax_token_validity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'vehicle_serial',
        'ragistration_number',
        'vehicle_type_id',
        'model_name',
        'model_year',
        'ragistration_date',
        'engine_capacity',
        'fitness_vality',
        'tax_token_validity',
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

    public function vehicleExpenses()
    {
        return $this->hasMany(Expense::class, 'vehicle_id', 'id');

    }

    public function ragistrationNumberDriverAllocations()
    {
        return $this->hasMany(DriverAllocation::class, 'ragistration_number_id', 'id');

    }

    public function vehicleSerialNumberVehicleAllocations()
    {
        return $this->belongsToMany(VehicleAllocation::class);

    }

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');

    }

    public function getRagistrationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setRagistrationDateAttribute($value)
    {
        $this->attributes['ragistration_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getFitnessValityAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setFitnessValityAttribute($value)
    {
        $this->attributes['fitness_vality'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getFitnessCertificateAttribute()
    {
        return $this->getMedia('fitness_certificate');

    }

    public function getTaxTokenValidityAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setTaxTokenValidityAttribute($value)
    {
        $this->attributes['tax_token_validity'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getTexTokenCertificateAttribute()
    {
        return $this->getMedia('tex_token_certificate');

    }

    public function getOtherDocumentsAttribute()
    {
        return $this->getMedia('other_documents');

    }
}
