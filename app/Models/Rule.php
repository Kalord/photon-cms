<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    /**
     * Current table
     * @var string
     */
    protected $table = 'rule';

    /**
     * Timestamp for records
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description'
    ];

    /**
     * Нахождение роли по ее названию
     *
     * @param string $title
     * @return Rule|null
     */
    public static function findRuleByTitle($title)
    {
        return self::where('title', $title)->first();
    }
}
