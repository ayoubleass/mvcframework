<?php


namespace Src\Base;

use Src\Base\Exception\BaseInvalidArgumentException;

class BaseEntity {


    public function __construct(array $dirtyData)
    {
        if(empty($dirtyData)){
            throw new BaseInvalidArgumentException(sprintf('%s must be an array',$dirtyData));
        }
        foreach($this->clean($dirtyData) as $key => $value){
            $this->$key = $value;
        }
    }


    private function clean(array $dirtyData) : array{
        
    }

    
}