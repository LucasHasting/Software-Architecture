<?php

class Pet {
    function __construct(private $name, private $type){}

    function setName($name){
        $this->name = $name;
        return $this;
    }

    function setType($type){
        $this->type = $type;
        return $this;
    }

    function getName(){
        return $this->name;
    }
}

$fluffy = new Pet("Fluffy", "cat");
echo $fluffy->getName();

$garfield = clone $fluffy;
$garfield->setName("Garfield");
echo $garfield->getName();
echo $fluffy->getName();

?>
