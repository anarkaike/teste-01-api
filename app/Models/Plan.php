<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
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
        'price' => '',

    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'plan_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    use HasFactory;

    public function customers()
    {
        return $this->belongsToMany(
            Customer::class,
            'customers_plans_rel',
            'plan_id',
            'customer_id');
    }
}
