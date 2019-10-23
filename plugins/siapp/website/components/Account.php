<?php namespace Siapp\Website\Components;

use Cms\Classes\ComponentBase;
use ApplicationException;

class Account extends ComponentBase
{

    public $active = false;
    public function componentDetails()
    {
        return [
            'name'        => 'Lista de contas',
            'description' => 'Permite o contas'
        ];
    }

    public function onRun(){
        
        dd($this->property('code'));
        exit();
    }


}
