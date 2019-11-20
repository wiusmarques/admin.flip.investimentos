<?php namespace siapp\Website\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class BlogCategories extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'website_blog_category' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('siapp.Website', 'website', 'blog-category');
    }
}
