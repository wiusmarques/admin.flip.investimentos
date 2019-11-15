<?php namespace siapp\Website\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use siapp\Website\Models\Content as SiappContent;
use Session;

class Content extends Controller
{
    public $implement = [        
        'Backend\Behaviors\ListController',        
        'Backend\Behaviors\FormController',
        'siapp\Website\Behaviors\SectionSelection',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'website_content' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('siapp.Website', 'website', 'website-contet');
    }

    public function makeList(){
        return ['aaaa'];
    }

    public function index($section = false){
        $sections = SiappContent::select('section')->groupBy('section')->lists('section');
        
        $this->vars['sections'] = $sections;

        if ($section) {
            Session::put('websiteSectionSelected', $section);
        }

        $this->vars['currentSection'] = Session::get('websiteSectionSelected', false);

        $this->asExtension('ListController')->index();
    }

    public function listExtendQuery($query)
    {
        
        $sectionSelected = Session::get('currentWbsiteSection');
        $content = SiappContent::select('section')->first();
        $section = $content->section ?? "";

        if(!empty($sectionSelected)){
            $section = $sectionSelected;
        }

        return $query->Where('section', $section);
    }
}
