<?php




namespace Src\Validation;


enum ValidationRule:string
{

    case REQUIRED  = 'required';    
    case EMAIL = 'email';
    case UNIQUE = 'unique';
    case PASSWORD = 'password';

}