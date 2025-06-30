<?php
require_once("tickets.class.php");
require_once("show.class.php");
require_once("movie.class.php");
require_once("account.class.php");
require_once("feedback.class.php");
class Admin extends Account{
    

    public function addMovie($movieTitle, $movieGenre, $movieDuration, $movieProdDate, $movieDirector, $movieActors, $movieImg, $movieTrailer,
    $mainHall, $privateHall, $vipHall, $showTimes){
        $movie = new Movie();

     $movie -> movieTitle = $movieTitle;
     $movie -> movieGenre = $movieGenre;
     $movie -> movieDuration = $movieDuration;
     $movie -> movieProdDate = $movieProdDate;
     $movie -> movieDirector = $movieDirector;
     $movie -> movieActors = $movieActors;
     $movie -> movieImg = $movieImg;
     $movie -> movieTrailer = $movieTrailer;
     $movie -> mainHall = $mainHall;
     $movie -> privateHall = $privateHall;
     $movie -> vipHall = $vipHall;
     $movie -> showTimes = $showTimes;

        $db = new Db();
        $db -> connect();

        // Check For Duplicate Movie Data
        $sql = "SELECT * FROM movies WHERE movieTitle = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt -> bind_param("s", $movie->movieTitle);
        $stmt -> execute();
        $result =  $stmt->get_result();
        if ($result->num_rows) {
            echo "This Data Cannot Be Set Because Of Duplicate";
            return;
        }

        // Inserting The Movie
        $this->id = 25;
        $sql = "INSERT INTO movies (adminId, movieTitle, movieGenre, movieDuration, movieProdDate, movieDirector, movieActors, movieImg, movieTrailer, mainHall, privateHall, vipHall) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->connection->prepare($sql);
        $stmt -> bind_param("ssssssssssss",$this->id, $movie->movieTitle, $movie->movieGenre, $movie->movieDuration, $movie->movieProdDate, $movie->movieDirector,
        $movie->movieActors, $movie->movieImg, $movie->movieTrailer, $movie->mainHall, $movie->privateHall, $movie->vipHall);
        if (!$stmt -> execute()) {
            echo "Error inserting movie: " . $stmt->error;
            return;
        }
        
        // Inserting The Show Times 
        $sql = "SELECT * FROM movies WHERE movieTitle = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt -> bind_param("s", $movie->movieTitle);
        $stmt -> execute();
        $result =  $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $movie -> movieId = $row['id'];
        $show = new Show();
        $show -> setShows($movie->movieId,$movie->showTimes);
        }
    

    public function deleteMovie($movieId){
        $db = new Db();
        $db -> connect();
        $movie = new Movie();
        $movie -> movieId = $movieId;

        // Delete Movies
        $sql = "DELETE FROM movies WHERE id = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt->bind_param("i", $movie->movieId);
        if (!$stmt->execute()) {
            echo "Error In Deleting In Movies Table: " . $stmt->error;
            return;
        }
        //Delete The Shows
        $show = new Show();
        $show -> deleteShows($movie->movieId);


        
    }

    public function updateMovie($movieId,$movieTitle, $movieGenre, $movieDuration, $movieProdDate, $movieDirector, $movieActors, $movieImg, $movieTrailer,
    $mainHall, $privateHall, $vipHall, $showTimes){
        $movie = new Movie();

     $movie -> movieId = $movieId;
     $movie -> movieTitle = $movieTitle;
     $movie -> movieGenre = $movieGenre;
     $movie -> movieDuration = $movieDuration;
     $movie -> movieProdDate = $movieProdDate;
     $movie -> movieDirector = $movieDirector;
     $movie -> movieActors = $movieActors;
     $movie -> movieImg = $movieImg;
     $movie -> movieTrailer = $movieTrailer;
     $movie -> mainHall = $mainHall;
     $movie -> privateHall = $privateHall;
     $movie -> vipHall = $vipHall;
     $movie -> showTimes = $showTimes;

        $db = new Db();
        $db -> connect();

        // Check For Duplicate Movie Data
        $sql = "SELECT * FROM movies WHERE movieTitle = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt -> bind_param("s", $movie->movieTitle);
        $stmt -> execute();
        $result =  $stmt->get_result();
        if ($result->num_rows) {
            echo "This Data Cannot Be Set Because Of Duplicate";
            return;
        }

        // Geeting The Movie Id
        /* $sql = "SELECT * FROM movies WHERE movieTitle = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt -> bind_param("s", $movie->movieTitle);
        $stmt -> execute();
        $result =  $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $movie -> movieId = $row['id']; */

        // Updating The Movie's Data
        $sql = "UPDATE movies SET movieTitle=?, movieGenre=?, movieDuration=?, movieProdDate=?, movieDirector=?, movieActors=?,
         movieImg=?, movieTrailer=?, mainHall=?, privateHall=?, vipHall=? WHERE id=?";
        $stmt = $db -> connection -> prepare($sql);
        $stmt -> bind_param("ssssssssiiii",
        $movie -> movieTitle,
        $movie -> movieGenre,
        $movie -> movieDuration,
        $movie -> movieProdDate,
        $movie -> movieDirector,
        $movie -> movieActors,
        $movie -> movieImg,
        $movie -> movieTrailer,
        $movie -> mainHall,
        $movie -> privateHall,
        $movie -> vipHall,
        $movie -> movieId);
        if (!$stmt->execute()) {
            echo "Error InUpdating In Movies Table: " . $stmt->error;
            return;
        }

        
        // Inserting The New Show Times
        $show = new Show();
        $show -> updateShows($movie->movieId,$movie->showTimes);
              
        
    } 

    public function setAdmin($id){
        $db = new Db();
        $db -> connect();
        $sql = "UPDATE users SET roleId = ? WHERE id = '$id'";
        $stmt = $db -> connection -> prepare($sql);
        $stmt -> bind_param("i",1);
        if(!$stmt -> execute()){
            echo "Error In Changing Role: " . $stmt->error;
                    return;
        }else{
             echo"Updated successfully";
        }
        }


    public function setReceptionist($id){
        $db = new Db();
        $db -> connect();
        $sql = "UPDATE users SET roleId = ? WHERE id = '$id'";
        $stmt = $db -> connection -> prepare($sql);
        $stmt -> bind_param("i",1);
        if(!$stmt -> execute()){
            echo "Error In Changing Role: " . $stmt->error;
            return;
        }else{
            echo"Updated successfully";
        }
    }
    public function showMovies(){
       
       $movie = new Movie();
       $movie -> showMovies();



    }
    public function viewFeedbacks(){
        $db = new Db();
        $db -> connect();
        $feed = new Feedback;
        $feed -> viewFeedbacks($db);
    }

    public function deleteTicket($id){
        $ticket = new Ticket();
        $ticket -> deleteTicket($id);

    }

    public function updateEticket($movieTitle, $ticketTheatre, $ticketTime, $item1, $qnt1, $item2, $qnt2,
    $item3, $qnt3, $ticketQnt){
        $ticket = new Ticket();
        $ticket -> updateEticket($movieTitle, $ticketTheatre, $ticketTime, $item1, $qnt1, $item2, $qnt2,
        $item3, $qnt3, $ticketQnt);

    }

    }



?>