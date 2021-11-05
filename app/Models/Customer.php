<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'name'  => '',
        'email' => '',
        'phone' => '',
        'state' => '',
        'city' => '',
        'birthday' => '',

    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    use HasFactory;

    public function customersPlans(){
        return $this->belongsToMany('App\Models\Plan', 'customers_plans_rel')->withPivot('id');;
    }

    public function plans()
    {
        return $this->belongsToMany(
            Plan::class,
            'customers_plans_rel',
            'customer_id',
            'plan_id');
    }
}
