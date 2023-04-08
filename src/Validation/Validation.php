<?php



namespace Src\Validation;



class Validation {


    
    protected array $data = [];
    



    protected const PATTERNS = [
        'email'    =>  '/^([a-zA-Z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/',
        'password' => '/^([a-zA-Z\d\.]{8,24})$/',
    ];
    



    protected array $errorMessages = [];
    



    public function __construct()
    {}


    
    
    public function load(array $requestContent){
        $this->data = $requestContent;
    }





    public function required(array $fields) : void {
        foreach($fields as $field){
            if(!array_key_exists($field,$this->data)){
                $this->errorMessages [] = $field  . ' is not found in the request submited data';
            }
            if(empty($this->data[$field]) || $this->data[$field] === ""){
                $this->errorMessages [$field][] =  $field . ' is required';
            }
        }
    }
            
                



    
    public function email(string $field){
        if(!preg_match(self::PATTERNS['email'],$field)){
            $this->errorMessages ['email'][] =  ' your email is incorrect';
        }
    }

    


    public function password(string $field){
        if(!preg_match(self::PATTERNS['password'],$field)){
            $this->errorMessages ['password'][] = 
             ' the password legnth must be between 8-24 characteres';
        }
    }


    
    public function match(){

    }


    
    
    public function unique(string $rule,array|string  $fields){

    }





    public function getMessages(){
        return $this->errorMessages;
    }




    la



}