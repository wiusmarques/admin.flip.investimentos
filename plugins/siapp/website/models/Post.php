<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class Post extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_blog_posts';

    public $belongsTo = [
        'category' => 'siapp\Website\Models\BlogCategory',
    ];

    public $attachOne = [
        'image' => 'System\Models\File',
        'banner_desktop' => 'System\Models\File',
        'banner_mobile' => 'System\Models\File',
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'category' => 'required',
        'title' => 'required',
        'short_description' => 'required',
        'content' => 'required',
        'keywords' => 'required',
        'image' => 'required',
        'banner_desktop' => 'required',
        'banner_mobile' => 'required',
    ];

    public $customMessage = [
        'category.required' => 'A categoria de post é um campo obrigatório',
        'title.required' => 'O título do post é um campo obrigatório',
        'short_description.required' => 'A descrição curta do post é um campo obrigatório',
        'content.required' => 'O conteúdo do post é um campo obrigatório',
        'keywords.required' => 'Pelo menos uma Tag deve ser informada',
        'image.required' => 'A imagem da capa é um campo obrigatório',
        'banner_desktop.required' => 'O banner desktop é um campo obrigatório',
        'banner_mobile.required' => 'O banner mobile é um campo obrigatório'
    ];
}
