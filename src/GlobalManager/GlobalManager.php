<?php



namespace Src\GlobalManager;

use Throwable;
use Src\GlobalManager\GlobalManagerInterface;
use Src\GlobalManager\Exception\GlobalManagerException;
use Src\GlobalManager\Exception\GlobalManagerInvalidArgumentException;

class GlobalManager implements GlobalManagerInterface
{

   
    public static function set(string $key, mixed $value) : void{
        $GLOBALS[$key] = $value;
    }

 
    public static function get(string $key){
        self::isGlobalValid($key); 
        try{
            return $GLOBALS[$key];
        }catch(Throwable $throwable) {
            throw new GlobalManagerException('An exception was thrown trying to retrieve the data.');
        }
    }



    /**
     * Check if we have a valid key and its not empty else throw an 
     * exception
     */
    private static function isGlobalValid(string $key) : void
    {
        if (empty($GLOBALS[$key])) {
            throw new GlobalManagerInvalidArgumentException('Invalid global key. Please ensure you have set the global state for ' . $key);
        }
        if (empty($key)) {
            throw new GlobalManagerInvalidArgumentException('Argument cannot be empty.');

        }
    }



}