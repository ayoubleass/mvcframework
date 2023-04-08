<?php


namespace Src\Session;


interface SessionInterface {



    public function set($key, $value) : void ;

    public function get(string $key,$default = null);

    public function delete(string $key) : bool;

    public function invalidate() : void ;

    public function flush(string $key,mixed $value);

    public function has(string $key) : bool ;

    

}