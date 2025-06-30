<?php
require_once("account.class.php");
//require_once("../model/db.php");
require_once("movie.class.php");
require_once("tickets.class.php");
require_once("payment.class.php");


class Customer extends Account{

    public  function bookTicket($movieId, $userId, $ticketTheatre, $ticketTime, $item1, $qnt1, $item2, $qnt2,
     $item3, $qnt3, $ticketQnt){
     $ticket = new Ticket();
     
     $ticket -> movieId = $movieId;//GET Method
     $ticket -> userId = $userId;//SESSION
     $ticket -> ticketTheatre = $ticketTheatre;
     $ticket -> ticketTime = $ticketTime;
     $ticket -> item1 = $item1;
     $ticket -> qnt1 = $qnt1;
     $ticket -> item2 = $item2;
     $ticket -> qnt2 = $qnt2;
     $ticket -> item3 = $item3;
     $ticket -> qnt3 = $qnt3;
     $ticket -> ticketQnt = $ticketQnt;
     


        $db = new Db();
        $db -> connect();
        $pay = new Payment(); 
        $sql = "SELECT * FROM tickets WHERE userId = ?";
            $stmt = $db->connection->prepare($sql);
            $stmt -> bind_param("i", $ticket -> userId);
            $stmt -> execute();
            $result =  $stmt->get_result();
            $alreadyBooked = false;

            while ($row = $result->fetch_assoc()) {
                if ($row['movieId'] == $ticket->movieId) {
                    $alreadyBooked = true;
                    break;
                }
            }

            if ($alreadyBooked) {
                echo "You have already booked this movie.";
            } else {

        
        $pay -> makePayment($ticket -> movieId,$ticket -> ticketTheatre,$ticket -> ticketQnt);
        $ticket -> amount = $pay -> getAmount();
        
        //Checking if The order Id Is Already In The Database
        while(true){
            $ticket -> orderId = $pay -> getOrderId();
            $sql = "SELECT * FROM tickets WHERE orderId = ?";
            $stmt = $db->connection->prepare($sql);
            $stmt -> bind_param("s", $ticket -> orderId);
            $stmt -> execute();
            $result =  $stmt->get_result();
            if (!$result->num_rows) {
                break;
            }
        }



        $sql = "INSERT INTO tickets (movieId, userId, ticketTheatre, ticketTime, item1, qnt1,
         item2, qnt2, item3, qnt3, ticketQnt, orderId, amount) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db -> connection -> prepare($sql);
        $stmt -> bind_param("iisssisisiisi",
        $ticket -> movieId,
        $ticket -> userId,
        $ticket -> ticketTheatre,
        $ticket -> ticketTime,
        $ticket -> item1,
        $ticket -> qnt1,
        $ticket -> item2,
        $ticket -> qnt2,
        $ticket -> item3,
        $ticket -> qnt3,
        $ticket -> ticketQnt,
        $ticket -> orderId,
        $ticket -> amount,
        );
        $stmt -> execute();
        $pay -> showBill($ticket -> userId,$ticket -> orderId);
    }
        
        
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