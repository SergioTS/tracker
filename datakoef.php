<?php

require('conf.php');
file_put_contents('d:\Usr\log\tracker\errorMy.log', '');

 
if (isset($_POST['dayOfWeek'])) {
    $dayOfWeek = $_POST['dayOfWeek'];
} else {
    exit();
}
if (isset($_POST['nameOfMonth'])) {
    $nameOfMonth = $_POST['nameOfMonth'];
} else {
    exit();
}
try {
    $db = new PDO('mysql:host=' .DB_HOST. ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare("SELECT dayfactor.Day_K FROM dayfactor WHERE dayfactor.DateDay = :dayOfWeek");
    $stmt->bindParam(':dayOfWeek', $dayOfWeek);
    $stmt->execute();
    $dayK = $stmt->fetch();

    $stmt = $db->prepare("SELECT monthfactor.Month_K FROM monthfactor WHERE monthfactor.DateMonth = :nameOfMonth");
    $stmt->bindParam(':nameOfMonth', $nameOfMonth);
    $stmt->execute();
    $monthK = $stmt->fetch();

    $res_K = $dayK[0] * $monthK[0];
} catch (PDOException $e) {
    //print "Error!: " . $e->getMessage() . "<br/>";
    $str = json_encode("Error!: ".$e->getMessage());
    file_put_contents('d:\Usr\log\tracker\errorMy.log', $str);
    die();
}
    
$js_json = json_encode($res_K);
echo $js_json;
?>

