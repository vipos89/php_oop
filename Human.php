<?php


class Human {
    public $firstName;
    public  $lastName;
    public $age;

    public function __construct($firstName, $lastName, $age)
    {
       $this->firstName = $firstName;
       $this->lastName = $lastName;
       $this->age = $age;
    }

    function sayHello(){
        echo 'Привет! Меня зовут'.$this->firstName." ".$this->lastName." Мне ".$this->age."лет";
    }
}
