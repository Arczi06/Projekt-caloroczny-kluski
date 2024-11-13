<?php

class FootballTeam {
    public $players = [];

    public $name;
    public $wins = 0;
    public $looses = 0;
    public $stadion;
    public function addPlayer($name, $birthDay, $height, $weight, $width){
        $player = new Player($name, $birthDay, $height, $weight, $width);
        array_push($this->players, $player);
    }
    public function __construct($name, $stadion){
        $this->name = $name;
        $this->stadion = $stadion;
    }
    function getName(){
        return $this->name;
        
    }
    function getWins(){
        return $this->wins;
        
    }
    function getLooses(){
        return $this->looses;
        
    }
    function getStadion(){
        return $this->stadion;
    }
    function addWin(){
        $this->wins++;
    }
    function addLose(){
        $this->looses++;
    }
    function countWinRation(){
        $this->wins/$this->looses;
    }
    public function getPlayers(){
        foreach($players as $player){
            array_push($array, array (
                $player -> getName(), 
                $player -> getBirthDay(), 
                $player -> getHeight(), 
                $player -> getWeight(), 
                $player -> getWidth()
            ));
        }
        return $array;   
    }
} 

class Player {
    public $name;
    public $birthDay;
    public $height;
    public $weight;
    public $width;
    public function __construct($name, $birthDay, $height, $weight, $width){
        $this->name = $name;
        $this->birthDay = $birthDay;
        $this->;
        $this->;
        $this->;
    }
    function getName(){
        return $this->name;
    }
    function getBirthDay(){
        return $this->birthDay;
    }
    function getHeight(){
        return $this->height;
    }
    function getWeight(){
        return $this->weight;
    }
    function getWidth(){
        return $this->width;
    }
}  

$klub = new FootballTeam ("NigaBrzegi","StadionBrzegi");
$klub->addPlayer("Adam Malysz", 1900, 190, 90, 100);
var_dump($klub);

?>