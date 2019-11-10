<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class Banner extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];
    const SORT_ORDER = 'sort_order';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_banners';

    public $attachOne = [
        'banner_desktop' => 'System\Models\File',
        'banner_mobile' => 'System\Models\File',
    ];

    public $belongsTo = [
        'location' => 'siapp\Website\Models\BannerLocation',
    ];

    /**
     * @var array Validation rules
     */
    
    public $rules = [
        'name' => 'required',
        'location' => 'required',
        'banner_desktop' => 'required',
        'banner_mobile' => 'required',
    ];

    public $customMessage = [
        'name.required' => 'O nome do banner é um campo obrigatório',
        'location.required' => 'A localização do banner é um campo obrigatório',
        'banner_desktop' => 'A imagem desktop do banner é obrigatória',
        'banner_mobile' => 'A imagem mobile do banner é obrigatória',
    ];
}
