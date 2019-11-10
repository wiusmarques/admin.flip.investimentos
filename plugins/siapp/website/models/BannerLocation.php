<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class BannerLocation extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_banners_locations';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required'
    ];

    public $customMessages = [
        'name.required' => 'É necessário informar o nome da localização para poder continuar',
    ];
}
