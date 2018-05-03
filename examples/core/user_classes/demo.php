<?php
namespace Foo;

class Demo {
    
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    public function config()
    {
        return $this->config;
    }

    public function this()
    {
        return $this;
    }
    
    public function test($x, $y)
    {
        return [$x, $y];
    }
    
}