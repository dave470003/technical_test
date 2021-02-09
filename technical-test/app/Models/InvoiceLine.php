<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Invoice Line Model
 *
 * @author David Fox <djwfox@gmail.com>
 */
class InvoiceLine extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Get the value of the line. Can be formatted to a printable string.
     *
     * @param boolean $format
     * @return string|numeric
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getValue($format = false)
    {
        if (!$format) {
            return $this->value;
        }
        return '£' . number_format($value, 2);
    }
}
