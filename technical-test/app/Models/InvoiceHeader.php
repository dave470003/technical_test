<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Invoice Header Model
 *
 * @author David Fox <djwfox@gmail.com>
 */
class InvoiceHeader extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
   protected $casts = [
       'date' => 'datetime:Y-m-d',
   ];

   /**
    * OneToMany link to invoice lines
    *
    * @return []App\Models\InvoiceLine
    *
    * @author David Fox <djwfox@gmail.com>
    */
    public function lines()
    {
        return $this->hasMany(InvoiceLine::class);
    }

    /**
     * ManyToOne link to locations
     *
     * @return App\Models\InvoiceLocation
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function location()
    {
        return $this->belongsTo(InvoiceLocation::class);
    }

    /**
     * Get the ID
     *
     * @return void
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the name of the linked location
     *
     * @return string
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getLocationName(): string
    {
        return $this->location->name;
    }

    /**
     * Get the status
     *
     * @return string
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get the date the invoice was issued
     *
     * @param boolean $format
     * @return mixed
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getDate($format = false)
    {
        if (!$format) {
            return $this->date;
        }
        return $this->date->format('Y-m-d');
    }

    /**
     * Get the total value of the invoice. Can be formatted to a printable string
     *
     * @param boolean $format
     * @return mixed
     *
     * @author David Fox <djwfox@gmail.com>
     */
    public function getValue($format = false)
    {
        $value = 0;
        foreach ($this->lines as $line) {
            $value += $line->getValue();
        }

        if (!$format) {
            return $value;
        }
        return '£' . number_format($value, 2);
    }
}
