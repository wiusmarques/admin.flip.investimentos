<?php namespace Siapp\Website\Components;

use Cms\Classes\ComponentBase;
use ApplicationException;
use RainLab\User\Models\User;
use siapp\Website\Models\ActivationCode;
use Auth;
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
        $register = ActivationCode::where('hash', $code)->where('valid_at', '>=', $now)->first();

        
        if(isset($register) && !empty($register)){
            var_dump($register);
            $user = Auth::findUserByLogin($register->user_mail);
            $user->is_activated = 1;
            $user->activated_at = date("Y-m-d H:i:s");
            
            $user->save();

            $this->$active = true;
            trace_log($register);
            trace_log($user);

        }else{
            //Nenhum registro encotnrado precisamos tratar
        }

        
    }


}
