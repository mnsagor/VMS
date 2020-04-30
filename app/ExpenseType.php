<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ExpenseType extends Model
{
    use SoftDeletes;

    public $table = 'expense_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'catagory_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function expenceCatogoryExpenses()
    {
        return $this->hasMany(Expense::class, 'expence_catogory_id', 'id');

    }
}
