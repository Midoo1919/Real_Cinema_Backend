<?php
class Feedback{


private $id;
private $userId;
private $message;

public function sendFeedback($userId, $message){
    $this -> message = filter_var($message, FILTER_SANITIZE_STRING);
    $this -> userId = $userId;
    $db = new Db();
    $db -> connect();
    
    $sql = "INSERT INTO feedback (userId, message) VALUES(?,?)";
    $stmt = $db->connection->prepare($sql);
    $stmt -> bind_param("is",$this -> userId,$this -> message);
    if (!$stmt -> execute()) {
        echo "Error inserting Feedback: " . $stmt->error;
        return;
    }
    
    
}
public function viewFeedbacks(Db $db){
    
    /* $db -> connect(); */
    $sql = "SELECT * FROM feedback";
    $stmt = $db -> connection -> query($sql);
        
        
    
    echo "<table border = '1'>";
    echo "<tr>"."<td>" . "<h4>Feedback Id</h4>" . "</td>" .  "<td>" . "<h4>User Id</h4>" . "</td>"
    .  "<td>" . "<h4>Message</h4>" . "</td></tr>";
        
        
        
        
        while($row = mysqli_fetch_assoc($stmt)){      
        echo "<tr> <td><h5>" . $row["feedbackId"] . "</h5></td>" .  "<td><h5>" . $row["userId"] . "</h5></td>" .  "<td><h5>" . $row["message"] . 
        "</h5></td></tr>";
        }
        echo "</table>"; 
            
        }




}







?>