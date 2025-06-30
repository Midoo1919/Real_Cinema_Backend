<?php
require_once("account.class.php");
require_once("payment.class.php");
require_once("tickets.class.php");
require_once("movie.class.php");
class Recp extends Account{


public function showMovies(){
    $movie = new Movie();
    $movie -> showMovies();

}




public function showTickets(){
    $ticket = new Ticket();
    $ticket -> showTickets();
}




public function updateEticket($movieTitle, $ticketTheatre, $ticketTime, $item1, $qnt1, $item2, $qnt2,
    $item3, $qnt3, $ticketQnt){
        $ticket = new Ticket();
        $ticket -> updateEticket($movieTitle, $ticketTheatre, $ticketTime, $item1, $qnt1, $item2, $qnt2,
        $item3, $qnt3, $ticketQnt);}




public function deleteTicket($id){
    $ticket = new Ticket();
    $ticket -> deleteTicket($id);

}

public function bookInCinema($movieId, $ticketTheatre, $ticketTime, $reserverName, $reserverEmail, $ticketQnt,
$payMethod){
    $db = new Db();
    $db ->connect();
    $pay = new Payment();
    $pay -> makePayment($movieId,$ticketTheatre,$ticketQnt);
        $amount = $pay -> getAmount();
        
        //Checking if The order Id Is Already In The Database
        while(true){
            $orderId = $pay -> getOrderId();
            $sql = "SELECT * FROM tickets WHERE orderId = ?";
            $stmt = $db->connection->prepare($sql);
            $stmt -> bind_param("s", $orderId);
            $stmt -> execute();
            $result =  $stmt->get_result();
            if (!$result->num_rows) {
                break;
            }
        }
    $sql = "INSERT INTO recepTickets (movieId, ticketTheatre, ticketTime, reserverName, reserverEmail, ticketQnt,
         orderId, amount, payMethod) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $db -> connection -> prepare($sql);
        $stmt -> bind_param("issssisis",
        $movieId,
        $ticketTheatre,
        $ticketTime,
        $reserverName,
        $reserverEmail,
        $ticketQnt,
        $orderId,
        $amount,
        $payMethod);
        $stmt -> execute();
        
        $pay -> showBillInSite($reserverName,$ticketTheatre,$amount,$orderId);



}















}








?>