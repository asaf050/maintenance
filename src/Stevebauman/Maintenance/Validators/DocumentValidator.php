<?php

namespace Stevebauman\Maintenance\Validators;

/**
 * Class DocumentValidator.
 */
class DocumentValidator extends FileValidator
{
    /**
     * {@inheritDoc}
     */
    protected $rules = [
        'files' => 'required|mimes:pdf,doc,docx,xls,xlsx',
    ];
}
