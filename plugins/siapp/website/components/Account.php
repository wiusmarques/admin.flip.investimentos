<?php namespace Siapp\Website\Components;

use Cms\Classes\ComponentBase;
use ApplicationException;
use siapp\Website\Models\ActivationCode;

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
        
        $code = $this->property('code');
        $now = date("Y-m-d H:i:s");
        $result = ActivationCode::where('hash', $code)->where('valid_at', '<=', $now)->get();
        trace_log($result);
        dd($result->user_mail);
    }


}
