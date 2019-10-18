<?php namespace siapp\Website;

use System\Classes\PluginBase;
use RainLab\User\Models\Settings as UserSettings;
use siapp\Website\Models\ActivationCode;
use siapp\Website\Classes\Mail;
use Route;
use Auth;
use Event;
use Validator;
use Request;
use Response;

class Plugin extends PluginBase
{


    public function boot(){
        
        Route::group(['prefix' => 'api/v1'], function () {
    
            Route::group(['prefix' => 'account'], function () {
                
                Route::post('create', function () {

                    /* 
                    * Início do bloco de seguraça
                    */
                    $validDomain = "*";
                    $domain = Request::server('HTTP_HOST');

                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');

                    // ActivationCode::sendActivationCode(post('email'));
                    // return post('email');
                    
                    // $mail = new Mail();
                    // return $mail->getValue();
                    

                    if ($validDomain != '*' && $validDomain != $domain) {
                        return Response::make('Access denied', 403);
                    }

                    /* 
                    * Fim do bloco de seguraça
                    */

                    /*
                    * Bloco com a tratativa dos dados informados 
                    */
                    $data = post();
                    $rules = [
                        'name' => 'required',
                        'email' => 'required|email|between:6,255',
                        'password' => 'required|between:' . UserSettings::MIN_PASSWORD_LENGTH_DEFAULT . ',255|confirmed',
                        'password_confirmation' => 'required|required_with:password|between:' . UserSettings::MIN_PASSWORD_LENGTH_DEFAULT . ',255',
                    ];

                    $errors = $this->validateData($data, $rules);
                    
                    if($errors != ""){
                        return $errors;
                    }
                    
                    $user = Auth::findUserByLogin($data['email']);

                    if($user){
                        return [
                            "Type" => "Erro",
                            "Data" => "Esta conta já está sendo utilizada.",
                        ];
                    }

                    
                    $user = Auth::register([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'password_confirmation' => $data['password_confirmation'],
                    ]);
                    
                    return $user;
                });
                
                Route::post('update', function () {
        
        
                    //return post();
                });
        
                
            });
            
        });
        
    }

    private function validateData($data, $rule){
        
        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            
            $messages = $validator->messages();

            $response = [
                "Type" => "Erro",
                "Data" => $messages->messages()
            ];
            
            return $response;
            
        }

        return "";


    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
