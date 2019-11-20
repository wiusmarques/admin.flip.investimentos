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
use siapp\Website\Models\Content;
use siapp\Website\Models\ResetPasswordCode;

class Plugin extends PluginBase
{


    public function boot(){
        /** Otimizar o código que faz os disparos, 
         * o código está muito estrutural e podemos escrever isso de forma melhor
         * */
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

                    $code = md5($data['email'] . date("Y-m-d H:i:s"));

                    $user = Auth::register([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'password_confirmation' => $data['password_confirmation'],
                    ]);

                    //trace_log($user);

                    if($user){

                        $url = url('/') . "/email/confirmation/" . $code . "/" . rawurlencode($user->name);
                        $html = file_get_contents($url);
                        
                        //trace_log($url);
                        
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

                            $objActivation->valid_at = date('Y-m-d H:i:s', strtotime(' + 30 day'));
                            $objActivation->hash = $code;

                            $objActivation->save();

                            return ['status' => 'success', 'message' => 'O código foi enviado para ' . $user->email];
                        } catch (Exception $e) {
                            trace_log("Erro ao tentar enviar o e-mail para: " . $user->email . " entre em contato com o administrador do sistema. \nMensagem de Erro: " . $e->getMessage());
                        }
                    }else{
                        $errors = ['status' => 'Erro', 'message' => 'Erro no envio do e-mail para ' . $user->email];
                        return Response::make($errors, 403);
                    }

                    
                });

                Route::post('reset/password', function(){
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
                    $now = date("Y-m-d H:i:s");

                    $rules = [
                        'email' => 'required|email|between:6,255',
                    ];

                    $errors = $this->validateData($data, $rules);
                    
                    if($errors != ""){
                        return Response::make($errors, 403);
                    }

                    $user = Auth::findUserByLogin($data['email']);

                    if(!$user){
                        $errors = [
                            "Type" => "Erro",
                            "Data" => "Essa conta não foi encontrada em nosso sistema",
                        ];

                        return Response::make($errors, 403);
                    }


                    if($user){
                        
                        $code = md5($user->mail . date("Y-m-d H:i:s"));

                        $user->activation_code = $code;
                        $user->reset_password_code = $code;
                        $user->persist_code = $code;
                        $user->save();

                        
                        $url = url('/') . "/password/reset/" . $code . "/";
                        $html = file_get_contents($url);
                        
                        //trace_log($url);
                        
                        $email = new \SendGrid\Mail\Mail(); 
                        $email->setFrom("noreply@flipinvestimentos.com", "Flip Invistimentos");
                        $email->setSubject("Alteração de Senha - Flip Investimentos");
                        $email->addTo($user->email, $user->name);
                        $email->addContent("text/html", $html);

                        $data = EmailProvider::select('key')->where("active", 1)->first();

                        //return $key;
                        
                        $sendgrid = new \SendGrid($data->key);

                        try {
                            $sendgrid->send($email);
                            
                            $objActivation = new ResetPasswordCode();
                            $objActivation->user_id = $user->id;
                            $objActivation->user_mail = $user->email;

                            $objActivation->valid_at = date('Y-m-d H:i:s', strtotime(' + 30 day'));
                            $objActivation->hash = $code;

                            $objActivation->save();

                            return ['status' => 'success', 'message' => 'O código foi enviado para ' . $user->email];
                        } catch (Exception $e) {
                            trace_log("Erro ao tentar enviar o e-mail para: " . $user->email . " entre em contato com o administrador do sistema. \nMensagem de Erro: " . $e->getMessage());
                        }
                    }else{
                        $errors = ['status' => 'Erro', 'message' => 'Erro no envio do e-mail para ' . $user->email];
                        return Response::make($errors, 403);
                    }
                    

                    return $user;
                });

                Route::post('resubmit/code', function () {
                    

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
                    $now = date("Y-m-d H:i:s");

                    $rules = [
                        'email' => 'required|email|between:6,255',
                    ];

                    $errors = $this->validateData($data, $rules);
                    
                    if($errors != ""){
                        return Response::make($errors, 403);
                    }

                    $registerActivation = ActivationCode::where('user_mail', $data['email'])->where('valid_at', '>=', $now)->first();
                    $user = Auth::findUserByLogin($registerActivation->user_mail);

                    if($user){

                        $code = $registerActivation->hash;
                        $url = "/email/confirmation/" . $code . "/" . rawurlencode($user->name);
                        $html = file_get_contents($url);
                        
                        //trace_log($url);
                        
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
            Components\Account::class => 'account',
            Components\Banners::class => 'banners',
        ];
    }

    public function registerSettings()
    {
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'contenttext' => [$this, 'contentText'],
                'contentimage' => [$this, 'contentImage'],
                'replace_regex' => [$this, 'replace_regex']
            ],
        ];
    }

    public function contentText($text, $section = '', $removeP = false, $description = ''){
        
        $code = md5($text . $section . $description);
        $content = Content::where("code", $code)->first();

        
        if(!$content){
            $content = new Content;
            $content->type = 'text';
            $content->text = $text;
            $content->code = $code;
            $content->section = $section;
            $content->description = $description;
            $content->url = url()->full();
            $content->save();
        }

        if ($removeP) {
            return str_replace(['<p>', '</p>'], '', $content->text);
        }

        return $content->text;
        
    }

    public function replace_regex($str, $search, $replace = null)
    {
        // Are they using the standard Twig syntax?
        if (is_array($search) && $replace === null)
        {
            return strtr($str, $search);
        }
        // Is this a regular expression?
        else if (preg_match('/^\/.+\/[a-zA-Z]*$/', $search))
        {
            return preg_replace($search, $replace, $str);
        }
        else
        {
            // Otherwise use str_replace
            return str_replace($search, $replace, $str);
        }
    }

    public function contentImage($url, $section = '', $identifier = '')
    {
        return $url;
    }
}
