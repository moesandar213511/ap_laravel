<?php

namespace App;

class Container{
    protected $bindings = [];

    public function bind($key,$value){
        $this->bindings[$key] = $value; // container ထဲ၀◌င်လာမဲ့ services တွေကို bindings array ထဲမှာ key,value နဲ့ သိမ်းထား။
    }
    public function resolve($key){ //to output service in container use resolve() in laravel
        return call_user_func($this->bindings[$key]);
    }
}
