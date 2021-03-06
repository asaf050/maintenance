<?php

namespace Stevebauman\Maintenance\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Maintenance\Traits\Relationships\HasUserTrait;
use Stevebauman\Inventory\Traits\InventoryStockMovementTrait;

/**
 * Class InventoryStockMovement.
 */
class InventoryStockMovement extends BaseModel
{
    use SoftDeletes;

    use InventoryStockMovementTrait;

    use HasUserTrait;

    /**
     * The inventory stock movements table.
     *
     * @var string
     */
    protected $table = 'inventory_stock_movements';

    /**
     * The fillable inventory stock movement attributes.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id',
        'user_id',
        'before',
        'after',
        'cost',
        'reason',
    ];

    /**
     * The inventory stock movement viewer.
     *
     * @var string
     */
    protected $viewer = 'Stevebauman\Maintenance\Viewers\Inventory\InventoryStockMovementViewer';

    /**
     * The belongsTo stock relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo('Stevebauman\Maintenance\Models\InventoryStock', 'stock_id', 'id');
    }

    /**
     * Returns the cost of the movement. If no cost is available it will return 0.00.
     *
     * @param $cost
     *
     * @return string
     */
    public function getCostAttribute($cost)
    {
        if ($cost === null) {
            return '0.00';
        }

        return $cost;
    }

    /**
     * Returns the change of a stock.
     *
     * For example: '+ 25' or '- 25'
     *
     * @return string
     */
    public function getChangeAttribute()
    {
        if ($this->before > $this->after) {
            return sprintf('- %s', $this->before - $this->after);
        } elseif ($this->after > $this->before) {
            return sprintf('+ %s', $this->after - $this->before);
        } else {
            return 'None';
        }
    }
}
