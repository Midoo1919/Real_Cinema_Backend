<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
require_once("../model/db.php");
//include("account.class.php");
class Movie{

public $movieId;
public $adminId;
public $movieTitle;
public $movieGenre;
public $movieDuration;
public $movieProdDate;
public $movieDirector;
public $movieActors;
public $movieImg;
public $movieTrailer;
public $mainHall;
public $privateHall;
public $vipHall;
public $showTimes;


public function showMovies(){
     $db = new Db();   
     $db -> connect(); 
        
        $sql = "SELECT * FROM movies";
        $stmt = $db -> connection -> query($sql);
        
        
    
    echo "<table border = '1'>";
    echo "<tr>"."<td>" . "<h4>Movie Id</h4>" . "</td>" .  "<td>" . "<h4>Admin Id</h4>" . "</td>"
    .  "<td>" . "<h4>Movie Title</h4>" . "</td>" . "<td>" . "<h4>Movie Genre</h4>" . "</td>" . "<td><h4>" . "Movie Duration" . "</h4></td>"
    . "<td><h4>Movie Produced Date</h4></td>" . "<td><h4>" . "Movie Director" . "</h4></td>" . "<td><h4>" . "Movie Actors" . "</h4></td>"
    . "<td><h4>" . "Main Hall" . "</h4></td>" . "<td><h4>" . "Private Hall" . "</h4></td>" . "<td><h4>" . "Vip Hall" . "</h4></td>" . "<td></td><td></td></tr>";
        
        
        
        
        while($row = mysqli_fetch_assoc($stmt)){
            $id = $row['id'];      
        echo "<tr> <td><h5>" . $row["id"] . "</h5></td>" .  "<td><h5>" . $row["adminId"] . "</h5></td>" .  "<td><h5>" . $row["movieTitle"] . 
        "</h5></td>" .  "<td><h5>" . $row["movieGenre"] . "</h5></td>" . "<td><h5>" . $row["movieDuration"] . "</h5></td>" .
        "<td><h5>" . $row["movieProdDate"] . "</h5></td>" ."<td><h5>" . $row["movieDirector"] . "</h5></td>" .
        "<td><h5>" . $row["movieActors"] . "</h5></td>" ."<td><h5>" . $row["mainHall"] . "</h5></td>" .  
        "<td><h5>" . $row["privateHall"] . "</h5></td>" ."<td><h5>" . $row["vipHall"] . "</h5></td>" ."<td><a href='updateMovie.php?id=$id'>Upgrade</a></td>"
        ."<td><a href='deleteMovie.php?id=$id'>Delete</a></td></tr>";
        }
        echo "</table>"; 
            
        }
   
}
?>
</body>
</html>