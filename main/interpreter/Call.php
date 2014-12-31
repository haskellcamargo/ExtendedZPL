<?php
namespace core\interpreter;

class Call
{
  public $key
       , $value;

  public function __construct($key, $value) 
  {
    $this->key   = $key;
    $this->value = $value;
    Linker :: bindCall($this);
  }
}