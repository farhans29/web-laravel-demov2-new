<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'm_inventory';
    protected $primaryKey = 'id_inventory';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

}
