<?php namespace siapp\Website;


use System\Classes\PluginBase;
use RainLab\User\Models\Settings as UserSettings;
use siapp\Website\Models\ActivationCode;

use Route;
use Auth;
use Event;
use Validator;
use Request;
use Response;
use siapp\Register\Models\EmailProvider;
use Siapp\Website\Components\Account;

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
                        return Response::make($errors, 403);
                    }
                    
                    $user = Auth::findUserByLogin($data['email']);

                    if($user){
                        $errors = [
                            "Type" => "Erro",
                            "Data" => "Esta conta já está sendo utilizada.",
                        ];

                        return Response::make($errors, 403);
                    }

                    
                    $user = Auth::register([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'password_confirmation' => $data['password_confirmation'],
                    ]);

                    trace_log($user);

                    if($user){

                        $code = md5($user->mail . date("Y-m-d H:i:s"));
                        $html = file_get_contents("http://www.siapptechs.com/email/confirmation/" . $code . "/" . $user->name);
                        
                        //trace_log($html);
                        
                        $email = new \SendGrid\Mail\Mail(); 
                        $email->setFrom("noreply@flipinvestimentos.com", "Flip Invistimentos");
                        $email->setSubject("Seja bem vindo! Que tal validarmos sua conta de e-mail?");
                        $email->addTo($user->email, $user->name);
                        $email->addContent("text/html", $html);

                        $data = EmailProvider::select('key')->where("active", 1)->first();

                        //return $key;
                        
                        $sendgrid = new \SendGrid($data->key);

                        try {
                            $sendgrid->send($email);
                            
                            $objActivation = new ActivationCode();
                            $objActivation->user_id = $user->id;
                            $objActivation->user_mail = $user->email;

                            $objActivation->valid_at = date('Y-m-d H:i:s', strtotime(' + 1 day'));
                            $objActivation->hash = $code;

                            $objActivation->save();

                            return ['status' => 'success', 'message' => 'O código foi enviado para ' . $user->email];
                        } catch (Exception $e) {
                            trace_log("Erro ao tentar enviar o e-mail para: " . $user->email . " entre em contato com o administrador do sistema. \nMensagem de Erro: " . $e->getMessage());
                        }
                    }else{
                        return ['status' => 'success', 'message' => 'O código foi enviado para ' . $user->email];
                    }

                    
                });


                
                Route::post('update', function () {
        
        
                    //return post();
                });
                
                Route::post('reset/password', function () {
                    

                    /* 
                    * Início do bloco de seguraça
                    */
                    $validDomain = "*";
                    $domain = Request::server('HTTP_HOST');

                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    

                    if ($validDomain != '*' && $validDomain != $domain) {
                        return Response::make('Access denied', 403);
                    }

                    /* 
                    * Fim do bloco de seguraça
                    */
                    
                    $data = post();

                    trace_log($data);
                    return "Sucesso";
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
        return [
            'Siapp\Website\Components\Account' => 'account'
        ];
    }

    public function registerSettings()
    {
    }
}
