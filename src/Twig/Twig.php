<?php



namespace Src\Twig;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Twig {


    public function __construct()
    {}


    
    public function init($cachPath = null){
        $loader = new FilesystemLoader(ROOT_DIR . '/templates');
        $twig = new Environment($loader, [
            //'cache' => '/path/to/compilation_cache',    
        ]);
        return $twig;
    } 



}