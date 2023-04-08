<?php



namespace Src\Traits;

use Src\Session\SessionManager;
use Src\GlobalManager\GlobalManager;
use Src\Base\Exception\BaseLogicException;
use Src\Session\SessionInterface;

trait SystemTrait
{

    /**
     * Initialize the system session at the entry point with in the 
     * application
     *
     * @param boolean $useSessionGlobal
     * @return void
     */
    public static function sessionInit(bool $useSessionGlobal = false,array  $options = []) 
    {
        $session = SessionManager::initialize($options);
        if (!$session) {
            throw new BaseLogicException('Please enable session within your session.yaml configuration file.');
        } else if ($useSessionGlobal === true) {
            GlobalManager::set('global_session', $session);
        } else {
            return $session;
        }
    }


    

}