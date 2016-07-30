<?php
    header ("Content-Type:text/xml");
    require '../+/sql.php';
    require '../+/usersonly.php';
    function username($id) {
        global $con;
        $result5 = mysqli_query($con, "SELECT username FROM users WHERE id ='$id'");
        if (!$result5) {
         echo("Error description: " . mysqli_error($con1));
    }
        $row5 = mysqli_fetch_array($result5, MYSQLI_BOTH);
        return $row5['username'];
    }
    
    if(isset($_GET['get'])) {
        $chat = isset($_GET['chat']) ? $_GET['chat'] : null;
        $newest = isset($_GET['selectAfter']) ? $_GET['selectAfter'] : null;
    } else {
        $chat = isset($_POST['chat']) ? $_POST['chat'] : null;
        $newest = isset($_POST['selectAfter']) ? $_POST['selectAfter'] : null;
    }
    //$chat = 4;
    $chatTable = "chat".$chat;

    $sql = "SELECT * FROM $chatTable WHERE id > '$newest' ORDER BY id";
    $result = mysqli_query($con1, $sql);
    if (!$result) {
         echo("Error description: " . mysqli_error($con1));
    }
    echo '<?xml version="1.0" encoding="utf-8" ?>';
    echo '<messages>';
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        echo '<msg>';
            echo '<id>'.$row['id'].'</id>';
            echo '<senderUsername>'.username($row['senderId']).'</senderUsername>';
            echo '<senderId>'.$row['senderId'].'</senderId>';
            echo '<content>'.$row['msgContent'].'</content>';
        echo '</msg>';
    }
    echo '</messages>';
?>