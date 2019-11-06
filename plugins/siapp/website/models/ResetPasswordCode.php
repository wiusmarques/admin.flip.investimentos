<?php namespace siapp\Website\Models;

use Model;

/**
 * Model
 */
class ResetPasswordCode extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'siapp_website_reset_password_codes';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
