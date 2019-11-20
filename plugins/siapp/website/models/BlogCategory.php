<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class BlogCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_blog_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required'
    ];

    public $customMessage = [
        'name.required' => 'O nome da categoria de post é um campo obrigatório'
    ];
}
