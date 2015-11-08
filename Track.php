<?php

Class Track {

    protected $name;
    protected $flow;
    protected $points = [];
    public static $flowMin = 0;
    public static $flowMax = 0;
    
/*
 * Create new track
 * @param string $name - road's name
 * @param string $flow - automobile's quantity
  */
    public function __construct($name, $flow) {
        $this->name = $name;
        $this->flow = $flow;
        self::$flowMax = (self::$flowMax < $flow) ? $flow : self::$flowMax;
        self::$flowMin = (self::$flowMin > $flow) ? $flow : self::$flowMin;
    }

 /*
 * Add coordinates to track
 * @param integer $xCoord - coordinate of 'X'
 * @param integer $yCoord - coordinate of 'Y'
  */    
    public function addPoint($xCoord, $yCoord) {
        $point = [$yCoord, $xCoord];
        $this->points[] = $point;
    }

 /*
 * Transform object to array
 * @return array - array for data transfer
 */    
    public function obj2arr() {
        return [
            'name' => $this->name,
            'flow' => $this->flow,
            'points' => $this->points
        ];
    }

}

?>