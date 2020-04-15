<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Models\FileUploader;

class Post extends Model
{
    const STATUS_DELETE = 0;
    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;

    const DEFAULT_LIMIT = 10;

    /**
     * Current table
     * @var string
     */
    protected $table = 'post';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'id_user',
        'id_category',
        'main_img',
        'alt_main_img',
        'content',
        'status'
    ];

    public static function getUploadPathMainImg()
    {
        return 'uploads/posts/main_img/';
    }

    public static function getUploadPathResources()
    {
        return 'uploads/posts/resources/';
    }

    /**
     * @param UploadedFile $main_img
     * @return string путь до загруженного файла
     */
    private static function uploadMainImg(UploadedFile $main_img)
    {
        $fileName = Str::random(8) . '.' . $main_img->extension();

        return FileUploader::upload(
            $main_img,
            self::getUploadPathMainImg(),
            $fileName
        );
    }

    private static function prepareDataForCreate(Array &$data, Array &$files)
    {
        $data['id_user'] = Auth()->id();
        $data['main_img'] = self::uploadMainImg($files['main_img']);
        unset($files['main_img']);

        $data['content'] = FileUploader::uploadResourceForPost(
            $data['content'],
            self::getUploadPathResources(),
            $files
        );
    }

    public static function findPosts(Array $findOptions)
    {
        $state = self::select('post.*', 'category.title AS category_title', 'user.name AS user_name')->
                       orderBy('id', 'desc')->
                       limit(self::DEFAULT_LIMIT);

        $state->join('category', 'post.id_category', '=', 'category.id');
        $state->join('user', 'post.id_user', '=', 'user.id');

        if(isset($findOptions['pivot'])) 
        {
            $state->where('id', '<', $findOptions['pivot']);
        }

        return $state->get();
    }

    public static function createPost(Array $data, Array $files)
    {
        self::prepareDataForCreate($data, $files);
        return self::create($data);
    }

    public static function setStatus($id, $status)
    {
        $post = self::findOrFail($id);
        $post->status = $status;
        $post->save();

        return $status;
    }

    /**
     * Сделать пост активным
     */
    public static function toActive($id)
    {
        return self::setStatus($id, self::STATUS_ACTIVE);
    }

    /**
     * Переместить пост в черновик
     */
    public static function toDraft($id)
    {
        return self::setStatus($id, self::STATUS_DRAFT);
    }

    /**
     * Переместить пост в корзину
     */
    public static function toTrash($id)
    {
        return self::setStatus($id, self::STATUS_DELETE);
    }
}
