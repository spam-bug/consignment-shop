<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'consignee_id',
        'contact_person',
        'contact_number',
        'street',
        'barangay',
        'city',
        'province',
    ];
}
