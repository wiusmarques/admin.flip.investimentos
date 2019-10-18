<?php namespace siapp\Website\Classes;

use siapp\Register\Models\EmailProvider;

class Mail{

    private $response = null;
    private $providerName;
    private $key;

    public function __construct(){
        $emailProvider = EmailProvider::where("active", 1)->first();
        $this->providerName = $emailProvider->name;
        $this->key = $emailProvider->key;
    }
    
    public function getValue(){
        trace_log($this->providerName);
        trace_log($this->key);

        return $this->response;
    }
    
}

?>