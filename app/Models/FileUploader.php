<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

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

        return $path . $fileName;
    }
}
