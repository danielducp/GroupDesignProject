<?php
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=g4udatabase", "root", "");
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
    
    // Attempt search query execution
    try{
        if(isset($_REQUEST["term"])){
            // create prepared statement
            $sql = "SELECT * FROM product  WHERE  CategoryID = 1 AND ProductName LIKE :term ";
            $stmt = $pdo->prepare($sql);
            $term = $_REQUEST["term"] . '%';
            // bind parameters to statement
            $stmt->bindParam(":term", $term);
            // execute the prepared statement
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch()){
                    echo "<a href='index.php?page=product&ProductCode=".$row['ProductCode']."'><p>$row[ProductName]</p></a>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        }  
    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
    
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
?>