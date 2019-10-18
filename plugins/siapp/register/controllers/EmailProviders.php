<?php namespace siapp\Register\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class EmailProviders extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'register_email_provider' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('siapp.Register', 'main-menu-item');
    }
}
