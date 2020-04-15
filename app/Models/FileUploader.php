<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileUploader extends Model
{
    /**
     * @param UploadedFile $file загружаемый файл
     * @param string $path путь до директории, в которую производится загрузка
     * @param string $fileName название файла
     *
     * @return string путь до загруженного файла
     */
    public static function upload(UploadedFile $file, $path, $fileName)
    {
        $file->move($path, $fileName);

        return '/' . $path . $fileName;
    }

    /**
     * @param string $content
     * @param array $files
     * @param string $path
     *
     * @return string
     */
    public static function uploadResourceForPost($content, $path, Array $files)
    {
        foreach($files as $key => $file)
        {
            $fileName = Str::random(8) . '.' . $file->extension();
            $pathToResource = self::upload($file, $path, $fileName);
            $content = preg_replace(
                '~\"\"~',
                "\"$pathToResource\"",
                $content,
                1);
        }

        return $content;
    }
}
