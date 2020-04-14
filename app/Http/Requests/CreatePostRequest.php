<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use App\Models\Post;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $minCategory = Category::min('id');
        $maxCategory = Category::max('id');

        $minStatus = Post::STATUS_DELETE;
        $maxStatus = Post::STATUS_ACTIVE;


        return [
            'title'         => 'required|min:8|max:100|unique:post,title',
            'description'   => 'required|max:160',
            'keywords'      => 'required|max:255',
            'id_category'   => "required|min:$minCategory|max:$maxCategory",
            'main_img'      => 'required|mimes:jpeg,bmp,png',
            'alt_main_img'  => 'required',
            'content'       => 'required|max:10000',
            'status'        => "required|min:$minStatus|max:$maxStatus"
        ];
    }
}
