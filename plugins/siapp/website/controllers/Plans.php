<?php namespace siapp\Website\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Plans extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'website_plans' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('siapp.Website', 'website', 'website_plans');
        $this->addJs(url('plugins/inetis/chequeemploi/assets/js/jquery.mask.min.js'));
        $this->addJs(url('plugins/inetis/chequeemploi/assets/js/plans/plans.js'));
    }
}
