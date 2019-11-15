<?php namespace siapp\Website\Behaviors;

use BackendAuth;
use Keios\Multisite\Models\Setting;
use Redirect;
use Session;
use siapp\Registers\Models\Company;
use View;
use siapp\Registers\Models\Project;

class SectionSelection extends \October\Rain\Extension\ExtensionBase
{
    /**
     * @var Reference to the extended object.
     */
    protected $controller;

    /**
     * Constructor
     */
    public function __construct($controller)
    {
        $this->controller = $controller;

    }

    public function onSaveCurrentSection()
    {
        $section = post('section');

        Session::put('currentWbsiteSection', $section);
        return Redirect::refresh();
    }
}
