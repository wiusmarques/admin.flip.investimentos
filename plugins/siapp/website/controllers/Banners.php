<?php namespace siapp\Website\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Banners extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    const SORT_ORDER = 'sort_order';

    public $requiredPermissions = [
        'website_banners' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('siapp.Website', 'website', 'banners');
    }

    public function reorderExtendQuery($query)
    {
        $query->orderBy('sort_order', 'asc')->get();
    }

    
}
