<?php
require_once("../model/db.php");
require_once("payment.class.php");

class Ticket{
public $ticketId;
public $movieId;
public $userId;
public $ticketTheatre;
public $ticketTime;
public $item1;
public $qnt1;
public $item2;
public $qnt2;
public $item3;
public $qnt3;
public $ticketQnt;
public $orderId;
public $amount;




public function showUserTickets($userId){
    $db = new Db();
    $db -> connect();
    $sql = "SELECT * FROM tickets WHERE userId =$userId ";
    $stmt = $db -> connection -> query($sql);
    echo "<table border = '1'>";
    echo "<tr>"."<td>" . "<h4>Ticket It</h4>" . "</td>" .  "<td>" . "<h4>Movie Id</h4>" . "</td>"
    .  "<td>" . "<h4>User Id</h4>" . "</td>" . "<td>" . "<h4>Ticket Theatre</h4>" . "</td>" . "<td><h4>" . "Ticket Time" . "</h4></td>"
    . "<td><h4>Item 1</h4></td>" . "<td><h4>" . "Quantity 1" . "</h4></td>" . "<td><h4>" . "Item 2" . "</h4></td>"
    . "<td><h4>" . "Quantity 2" . "</h4></td>" . "<td><h4>" . "Item 3" . "</h4></td>" . "<td><h4>" . "Quantity 3" .
    "</h4></td>"  . "<td><h4>" . "Ticket Qnt" .
    "</h4></td>" . "<td><h4>" . "Order Id" .
    "</h4></td>" . "<td><h4>" . "Amount" .
    "</h4></td>" . "<td></td><td></td></tr>";
    while($row = mysqli_fetch_assoc($stmt)){
        $id = $row['id'];      
        echo "<tr> <td><h5>" . $row["id"] . "</h5></td>" .  "<td><h5>" . $row["movieId"] . "</h5></td>" .  "<td><h5>" . $row["userId"] . 
        "</h5></td>" .  "<td><h5>" . $row["ticketTheatre"] . "</h5></td>" . "<td><h5>" . $row["ticketTime"] . "</h5></td>" .
        "<td><h5>" . $row["item1"] . "</h5></td>" ."<td><h5>" . $row["qnt1"] . "</h5></td>" .
        "<td><h5>" . $row["item2"] . "</h5></td>" ."<td><h5>" . $row["qnt2"] . "</h5></td>" .  
        "<td><h5>" . $row["item3"] . "</h5></td>" ."<td><h5>" . $row["qnt3"] .
        "<td><h5>" . $row["ticketQnt"] . "</h5></td>" ."<td><h5>" . $row["orderId"] .
        "<td><h5>" . $row["amount"] .
        "</h5></td>" ."<td><a href='updateTickets.php?id=$id'>Upgrade</a></td>"
        ."<td><a href='deleteTickets.php?id=$id'>Delete</a></td></tr>";
        }
        echo "</table>"; 
}

public function showTickets(){
    $db = new Db();
    $db -> connect();
    $sql = "SELECT * FROM tickets";
    $stmt = $db -> connection -> query($sql);
    
    

echo "<table border = '1'>";
echo "<tr>"."<td>" . "<h4>Ticket It</h4>" . "</td>" .  "<td>" . "<h4>Movie Id</h4>" . "</td>"
.  "<td>" . "<h4>User Id</h4>" . "</td>" . "<td>" . "<h4>Ticket Theatre</h4>" . "</td>" . "<td><h4>" . "Ticket Time" . "</h4></td>"
. "<td><h4>Item 1</h4></td>" . "<td><h4>" . "Quantity 1" . "</h4></td>" . "<td><h4>" . "Item 2" . "</h4></td>"
. "<td><h4>" . "Quantity 2" . "</h4></td>" . "<td><h4>" . "Item 3" . "</h4></td>" . "<td><h4>" . "Quantity 3" .
 "</h4></td>"  . "<td><h4>" . "Ticket Qnt" .
 "</h4></td>" . "<td><h4>" . "Order Id" .
 "</h4></td>" . "<td><h4>" . "Amount" .
 "</h4></td>" . "<td></td><td></td></tr>";
    
    
    
    
    while($row = mysqli_fetch_assoc($stmt)){
    $id = $row['id'];      
    echo "<tr> <td><h5>" . $row["id"] . "</h5></td>" .  "<td><h5>" . $row["movieId"] . "</h5></td>" .  "<td><h5>" . $row["userId"] . 
    "</h5></td>" .  "<td><h5>" . $row["ticketTheatre"] . "</h5></td>" . "<td><h5>" . $row["ticketTime"] . "</h5></td>" .
    "<td><h5>" . $row["item1"] . "</h5></td>" ."<td><h5>" . $row["qnt1"] . "</h5></td>" .
    "<td><h5>" . $row["item2"] . "</h5></td>" ."<td><h5>" . $row["qnt2"] . "</h5></td>" .  
    "<td><h5>" . $row["item3"] . "</h5></td>" ."<td><h5>" . $row["qnt3"] .
    "<td><h5>" . $row["ticketQnt"] . "</h5></td>" ."<td><h5>" . $row["orderId"] .
    "<td><h5>" . $row["amount"] .
    "</h5></td>" ."<td><a href='updateTickets.php?id=$id'>Upgrade</a></td>"
    ."<td><a href='deleteTickets.php?id=$id'>Delete</a></td></tr>";
    }
    echo "</table>"; 
        
    }

public function updateEticket($movieTitle, $ticketTheatre, $ticketTime, $item1, $qnt1, $item2, $qnt2,
    $item3, $qnt3, $ticketQnt){
        $db = new Db();
        $db -> connect();
     
     
     
     $this -> ticketTheatre = $ticketTheatre;
     $this -> ticketTime = $ticketTime;
     $this -> item1 = $item1;
     $this -> qnt1 = $qnt1;
     $this -> item2 = $item2;
     $this -> qnt2 = $qnt2;
     $this -> item3 = $item3;
     $this -> qnt3 = $qnt3;
     $this -> ticketQnt = $ticketQnt;

        //Getting The Movie Id
        $sql = "SELECT * FROM movies WHERE movieTitle = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt -> bind_param("s", $movieTitle);
        $stmt -> execute();
        $result =  $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        $this -> movieId = $row['id'];


        //Checking If The New Data Is Already Reaserved By This User
        $pay = new Payment(); 
        $sql = "SELECT * FROM tickets WHERE userId = ?";
            $stmt = $db->connection->prepare($sql);
            $stmt -> bind_param("i", $this -> userId);
            $stmt -> execute();
            $result =  $stmt->get_result();
            $alreadyBooked = false;

            while ($row = $result->fetch_assoc()) {
                if ($row['movieId'] == $this->movieId) {
                    $alreadyBooked = true;
                    break;
                }
            }

            if ($alreadyBooked) {
                echo "You have already booked this movie.";
            } else {

        
        $pay -> makePayment($this -> movieId,$this -> ticketTheatre,$this -> ticketQnt);
        $this -> amount = $pay -> getAmount();
        
        //Checking if The order Id Is Already In The Database
        while(true){
            $this -> orderId = $pay -> getOrderId();
            $sql = "SELECT * FROM tickets WHERE orderId = ?";
            $stmt = $db->connection->prepare($sql);
            $stmt -> bind_param("s", $this -> orderId);
            $stmt -> execute();
            $result =  $stmt->get_result();
            if (!$result->num_rows) {
                break;
            }
        }
        //Getting The Movie Id
        $sql = "SELECT * FROM tickets WHERE userId=? AND movieId=?";
            $stmt = $db->connection->prepare($sql);
            $stmt -> bind_param("ii", $this -> userId,$this->movieId);
            $stmt -> execute();
            $result =  $stmt->get_result();
            $row = mysqli_fetch_assoc($result);
            $this->ticketId = $row['ticketId'];


        // Updating The Ticket's Data
         $sql = "UPDATE tickets SET movieId=?, ticketTheatre=?, ticketTime=?, item1=?, qnt1=?,
         item2=?, 1nt2=?, item3=?, qnt3=?, amount=?, orderId=? WHERE id=?";
        $stmt = $db -> connection -> prepare($sql);
        $stmt -> bind_param("ssssssssiiii",
        $this -> movieId,
        $this -> ticketTheatre,
        $this -> ticketTime,
        $this -> item1,
        $this -> qnt1,
        $this -> item2,
        $this -> qnt2,
        $this -> item3,
        $this -> qnt3,
        $this -> ticketQnt,
        $this -> amount);
        if (!$stmt->execute()) {
            echo "Error In Updating Movies Table: " . $stmt->error;
            return;
        }
}
}








public function deleteTicket($id){
    $db = new Db();
    $db -> connect();
    $this -> ticketId = $id;  
    
    // Delete Ticket
    $sql = "DELETE FROM tickets WHERE ticketId = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param("i",$this -> ticketId);
    if (!$stmt->execute()) {
        echo "Error In Canceling The Ticket: " . $stmt->error;
        return;
    } 

}



}







?>