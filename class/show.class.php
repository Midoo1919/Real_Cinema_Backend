<?php
require_once("../model/db.php");


class Show {
    private $shows;
    private $movieId;

public function setShows($movieId,$shows){
    $db = new Db();
    $db -> connect();
    $this -> shows = $shows;
    $this -> movieId = $movieId;

    // Inserting The Show Times 
    $array = explode(",",$this->shows);
    foreach($array as $times){
        $cinema = strstr($times, '.', true);
        $pos = strpos($times, '.');
        $show = substr($times, $pos+1);
        
        $sql = "INSERT INTO shows (movieId,showTime,cinemaInShow) VALUES(?,?,?)";
        $stmt = $db->connection->prepare($sql);
        $stmt->bind_param("iss", $this->movieId, $show, $cinema);
            if (!$stmt->execute()) {
                echo "Error inserting show time: " . $stmt->error;
                return;
            }
    }


}
public function deleteShows($movieId){
    $db = new Db();
    $db -> connect();
    $this -> movieId = $movieId;
    $sql = "DELETE FROM shows WHERE movieId = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param("i", $this->movieId);
    if (!$stmt->execute()) {
        echo "Error In Deleting In Shows Table: " . $stmt->error;
        return;
    }/* else
    { header("movies.php");} *///Put The Name Of The File Here

}
public function updateShows($movieId,$shows){
    $db = new Db();
    $db -> connect();
    $this -> movieId = $movieId;
    $this -> shows = $shows;
    $this -> deleteShows($this->movieId);
    $this -> setShows($this->movieId,$this->shows);
}
}










?>