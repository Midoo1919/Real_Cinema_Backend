<?php

class Payment
{

    private $ticketId;
    private $movieId;
    private $name;
    private $ticketTheatre;
    private $ticketQnt;
    private $amount;
    private $orderId;


    public function makePayment($movieId, $ticketTheatre, $ticketQnt)
    {

        $this->movieId = $movieId;
        $this->ticketTheatre = $ticketTheatre;


        $this->ticketQnt = $ticketQnt;

        $db = new Db();
        $db->connect();
        $sql = "SELECT * FROM movies WHERE id = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt->bind_param("i", $this->movieId);
        $stmt->execute();
        $result =  $stmt->get_result();
        if ($result->num_rows) {
            $row = mysqli_fetch_assoc($result);
            $value = $row["$ticketTheatre"];
            $this->amount = $value * $this->ticketQnt;
         
        } else {
            echo "This Movie Isn't Available";
        }
    }


    public function getAmount()
    {
        return $this->amount;
    }


    public function getOrderId()
    {
        $this->orderId = "ARZAQ" . rand(10000, 999999);
        return $this->orderId;
    }


    public function showBill($userId,$orderId){
        $this -> orderId = $orderId;
        $db = new Db();
        $db->connect();
        $sql1 = "SELECT * FROM users WHERE id = ?";
        $stmt1 = $db->connection->prepare($sql1);
        $stmt1->bind_param("i", $userId);
        $stmt1->execute();
        $result1 =  $stmt1->get_result();
        $row1 = mysqli_fetch_assoc($result1);
        $this -> name = $row1['name'];


        echo"<table border='1'style = 'text-align:center'>
        <tr><td colspan='2'>Bill Reseet</td></tr>
        <tr><td>Order ID</td><td>".$this -> orderId."</td></tr>
        <tr><td>Name</td><td>".$this -> name."</td></tr>
        <tr><td>Web Site</td><td>ARZAQ SITE</td></tr>
        <tr><td>Theatre</td><td>".$this -> ticketTheatre."</td></tr>
        <tr><td>Price</td><td>". $this -> amount ."</td></tr>
        <tr><td colspan='2'>Make Sure To Save This Reseet</td></tr></table>";
        
    }
    public function showBillInSite($name,$ticketTheatre,$amount,$orderId){
        echo"<table border='1'style = 'text-align:center'>
        <tr><td colspan='2'>Bill Reseet</td></tr>
        <tr><td>Order ID</td><td>".$orderId."</td></tr>
        <tr><td>Name</td><td>".$name."</td></tr>
        <tr><td>Web Site</td><td>ARZAQ SITE</td></tr>
        <tr><td>Theatre</td><td>".$ticketTheatre."</td></tr>
        <tr><td>Price</td><td>". $amount ."</td></tr>
        <tr><td colspan='2'>Make Sure To Save This Reseet</td></tr></table>";
        
    }


}
