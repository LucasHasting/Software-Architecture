<?php

class Person {
    //attributes
    
    private $name, $address, $email;
    private float $age;

    //function __construct(private $name, private $address, private $email, private $age){}
    function __construct($name, $address, $email, $age){
        $this->name = $name;
        $this->address = $address;
        $this->email = $email;
        $this->age = $age;
    }

    //methods
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }
}

//$bob = new Person();
//$bob->setName("Bob");

//echo "Name: " . $bob->getName() . "\n";

$alice = new Person("Alice", "#111", "alice@una.edu", 1000);

echo "Name: " . $alice->getName() . "\n";

class User extends Person {
    private $account;

    function __construct($name, $address, $email, $age, $account){
        parent::__construct($name, $address, $email, $age);
        $this->account = $account;
    }

    function display() {
        echo "Name: " . parent::getName() . "\n";
        echo "Account " . $this->account . "\n";
    }
}

$joe = new User("Joe", "#222", "joe@una.edu", 51, 123456);
$joe->display();

?>
