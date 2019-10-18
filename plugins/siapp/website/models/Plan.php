<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class Plan extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    const SORT_ORDER = 'sort_order';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_plans';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'old_price' => 'required',
        'price' => 'required',
        'validate' => 'required',
    ];

    public $customMessages = [
        'name.required' => 'Informe o nome do plano.',
        'old_price.required' => 'O campo Preço Antigo é importante para propaganda de ofertas. (De "X" por apenas "Y")',
        'price.required' => 'O preço do plano é obrigatório',
        'validate.required' => 'Precisamos informar até quando o preço atual será válido.',
    ];

    public $attachOne = [
        'background_image' => 'System\Models\File',
    ];
}
