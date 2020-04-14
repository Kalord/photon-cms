<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS_DELETE = 0;
    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;

    /**
     * Current table
     * @var string
     */
    protected $table = 'post';

    public static function createPost(Array $data)
    {
        $data['id_user'] = Auth()->id();

        return self::create($data);
    }
}
