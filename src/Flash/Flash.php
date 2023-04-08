<?php


namespace Src\Flash;

use Magma\Flash\FlashTypes;
use Src\GlobalManager\GlobalManager;


class Flash {


    protected const FLASH_KEY = 'flash_message';
    
    
    public static function add(string $message, string $type = FlashTypes::SUCCESS) : void{
        $session = GlobalManager::get('global_session');
        if (!$session->has(self::FLASH_KEY)) {
            $session->set(self::FLASH_KEY, []);
        }
        $session->setArray(self::FLASH_KEY, ['message' => $message, 'type' => $type]);
    }

    
    
    public static function get(){
        $session = GlobalManager::get('global_session');
        $session->flush(self::FLASH_KEY);
    }



}