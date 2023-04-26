<?php 

session_start();
ob_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=googlegiris", "root", "");
    //echo "Bağlantı Başarılı";
} catch ( PDOException $e ){
    print $e->getMessage();
}

?>