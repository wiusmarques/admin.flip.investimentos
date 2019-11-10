<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class Banner extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_banners';

    public $attachOne = [
        'banner_desktop' => 'System\Models\File',
        'banner_mobile' => 'System\Models\File',
    ];

    public $belongsTo = [
        'location_id' => 'siapp\Website\Models\BannerLocation',
    ];

    /**
     * @var array Validation rules
     */
    
    public $rules = [
        'name' => 'required',
        'location_id' => 'required',
        'banner_desktop' => 'required',
        'banner_mobile' => 'required',
    ];

    public $customMessage = [
        'name.required' => 'O nome do banner é um campo obrigatório',
        'location_id.required' => 'A localização do banner é um campo obrigatório',
        'banner_desktop' => 'A imagem desktop do banner é obrigatória',
        'banner_mobile' => 'A imagem mobile do banner é obrigatória',
    ];
}
