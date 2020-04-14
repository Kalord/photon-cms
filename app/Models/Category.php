<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Current table
     * @var string
     */
    protected $table = 'category';

    /**
     * Timestamp for records
     * @var bool
     */
    public $timestamps = false;
}
