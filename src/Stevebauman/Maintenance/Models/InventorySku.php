<?php

namespace Stevebauman\Maintenance\Models;

use Stevebauman\Inventory\Traits\InventorySkuTrait;

class InventorySku extends BaseModel
{
    use InventorySkuTrait;

    /**
     * The inventory SKUs table.
     *
     * @var string
     */
    protected $table = 'inventory_skus';

    /**
     * The fillable inventory SKU attributes.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'prefix',
        'code',
    ];

    /**
     * The belongsTo item trait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('Stevebauman\Maintenance\Models\Inventory', 'inventory_id', 'id');
    }
}
