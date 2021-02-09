<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Invoice Location model
 *
 * @author David Fox <djwfox@gmail.com>
 */
class InvoiceLocation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'locations';

    /**
     * Getter for the name of the location
     *
     * @return string
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getName(): string
    {
        return $this->name;
    }
}
