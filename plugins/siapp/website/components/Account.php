<?php namespace Siapp\Website\Components;

use Cms\Classes\ComponentBase;
use ApplicationException;
use RainLab\User\Models\User;
use siapp\Website\Models\ActivationCode;
use Auth;
use Pheanstalk\Exception;
use siapp\Website\Models\ResetPasswordCode;

class Account extends ComponentBase
{

    public $code, $response;

    public function componentDetails()
    {
        return [
            'name'        => 'Lista de contas',
            'description' => 'Permite o contas'
        ];
    }

    public function onRun(){
        
        $this->code = $this->property('code');
        $now = date("Y-m-d H:i:s");
        $registerActivation = ActivationCode::where('hash', $this->code)->where('valid_at', '>=', $now)->first();

        
        if(isset($registerActivation) && !empty($registerActivation)){
            
            $user = Auth::findUserByLogin($registerActivation->user_mail);
            $user->is_activated = 1;
            $user->activated_at = date("Y-m-d H:i:s");
            
            $user->activation_code = $this->code;
            $user->reset_password_code = $this->code;

            $user->save();
            
            $this->response = [
                "status" => true,
                "message" => "Conta ativada com sucesso!"
            ];
            
            ActivationCode::where('hash', $this->code)->where('valid_at', '>=', $now)->delete();


        }else{
            

            $password = post('password');
            $password_confirmation = post('password_confirmation');

            if(!empty($password) && !empty($password_confirmation)){
                $registerActivation = ResetPasswordCode::where('hash', $this->code)->where('valid_at', '>=', $now)->first();
                $user = Auth::findUserByLogin($registerActivation->user_mail);
                
                try{
                    $user->password = $password;
                    $user->password_confirmation = $password_confirmation;
                    $user->save();
                }catch(Exception $e){
                    var_dump($e->getMessage());
                }
                
                //var_dump($user);
            }else{
                //dd("vazio");
            }
            
            //Nenhum registro encotnrado precisamos tratar
        }

        
    }


}
