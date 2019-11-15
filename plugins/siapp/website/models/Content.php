<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class Content extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_content';

    public function getSectionOptions(){
        return [];
    }

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
