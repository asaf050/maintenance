<?php

namespace Stevebauman\Maintenance\Models;

use Baum\Node;

/**
 * Class Location.
 */
class Location extends Node
{
    protected $table = 'locations';

    protected $fillable = [
        'name',
    ];

    protected $revisionFormattedFieldNames = [
        'name' => 'Name',
    ];

    /**
     * Returns a single lined string with arrows indicating depth of the current category.
     *
     * @return string
     */
    public function getTrailAttribute()
    {
        return renderNode($this);
    }

    /**
     * Compatibility with Revisionable.
     *
     * @return string
     */
    public function identifiableName()
    {
        return $this->getTrailAttribute();
    }
}
