<?php

namespace Stevebauman\Maintenance\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Maintenance\Traits\Relationships\HasCategoryTrait;
use Stevebauman\Maintenance\Traits\Relationships\HasEventsTrait;
use Stevebauman\Maintenance\Traits\Relationships\HasLocationTrait;
use Stevebauman\Maintenance\Traits\Relationships\HasUserTrait;

class Asset extends BaseModel
{
    use SoftDeletes;

    use HasUserTrait;
    use HasEventsTrait;
    use HasLocationTrait;
    use HasCategoryTrait;

    /**
     * The assets table.
     *
     * @var string
     */
    protected $table = 'assets';

    /**
     * The asset viewer class.
     *
     * @var string
     */
    protected $viewer = 'Stevebauman\Maintenance\Viewers\AssetViewer';

    /**
     * The fillable asset attribute.s
     *
     * @var array
     */
    protected $fillable = [
        'import_id',
        'user_id',
        'location_id',
        'category_id',
        'name',
        'description',
        'condition',
        'size',
        'weight',
        'vendor',
        'make',
        'model',
        'serial',
        'price',
        'acquired_at',
        'end_of_life',
    ];

    /**
     * The revisionable formatted field names.
     *
     * @var array
     */
    protected $revisionFormattedFieldNames = [
        'location_id' => 'Location',
        'category_id' => 'Category',
        'name' => 'Name',
        'description' => 'Description',
        'condition' => 'Condition',
        'size' => 'Size',
        'weight' => 'Weight',
        'vendor' => 'Vendor',
        'make' => 'Make',
        'model' => 'Model',
        'serial' => 'Serial',
        'price' => 'Price',
        'acquired_at' => 'Acquired At',
        'end_of_life' => 'End of Life',
    ];

    /**
     * The belongsToMany images relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('Stevebauman\Maintenance\Models\Attachment', 'asset_images', 'asset_id', 'attachment_id');
    }

    /**
     * The belongsToMany manuals relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function manuals()
    {
        return $this->belongsToMany('Stevebauman\Maintenance\Models\Attachment', 'asset_manuals', 'asset_id', 'attachment_id');
    }

    /**
     * The belongsToMany work orders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workOrders()
    {
        return $this->belongsToMany('Stevebauman\Maintenance\Models\WorkOrder', 'work_order_assets', 'asset_id', 'work_order_id')->withTimestamps();
    }

    /**
     * The belongsToMany meters relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meters()
    {
        return $this->belongsToMany('Stevebauman\Maintenance\Models\Meter', 'asset_meters', 'asset_id', 'meter_id')->withTimestamps();
    }

    /*
     * Filters query by the inputted asset name
     */
    public function scopeName($query, $name = null)
    {
        if ($name) {
            return $query->where('name', 'LIKE', '%'.$name.'%');
        }

        return $query;
    }

    /*
     * Filters query by the inputted asset condition
     */
    public function scopeCondition($query, $condition = null)
    {
        if ($condition) {
            return $query->where('condition', 'LIKE', '%'.$condition.'%');
        }

        return $query;
    }

    /*
     * Mutator for conversion of integer condition,
     * to text condition through translator.
     *
     * @return string
     */
    public function getConditionAttribute($attr)
    {
        return trans(sprintf('maintenance::assets.conditions.%s', $attr));
    }

    /**
     * Mutator for retrieving the condition number.
     *
     * @return mixed
     */
    public function getConditionNumberAttribute()
    {
        return $this->attributes['condition'];
    }

    /*
     * Mutator for displaying a pretty link label for display in work orders
     *
     * @return string.
     */
    public function getLabelAttribute()
    {
        return sprintf(
            '<a href="%s" class="label label-primary">%s</span></a>',
            route('maintenance.assets.show', [$this->attributes['id']]),
            $this->attributes['name']
        );
    }
}
