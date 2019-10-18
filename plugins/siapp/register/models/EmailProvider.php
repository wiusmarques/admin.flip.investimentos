<?php namespace siapp\Register\Models;

use Model;

/**
 * Model
 */
class EmailProvider extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_register_email_provider';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
