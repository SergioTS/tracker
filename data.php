<?php

require('conf.php');
require_once ('Track.php');

//file_put_contents('d:\Usr\log\tracker\error.log', '');
//$string = '';

if (isset($_POST['TS']) and isset($_POST['TD'])) {
    $TS = $_POST['TS'];
    $TD = $_POST['TD'];
} else {
    exit();
}

switch ($TS) {
    case '1':
    default :
        $pr = 'car';
        break;
    case '2':
        $pr = 'smallTruck';
        break;
    case '3':
        $pr = 'bigTruck';
        break;
    case '4':
        $pr = 'smallBus';
        break;
    case '5':
        $pr = 'bigBus';
        break;
    case '6':
        $pr = 'inAll';
        break;
}
$word = ($TD == 'one') ? 'F' : 'E';

$field = $pr . $word;

try {
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    $stmt = $db->query("SELECT xy.FROM, xy.TO, xy.INDEX, xy.XCOORD, xy.YCOORD, flow.POTOK, flow.NAME
FROM xy JOIN (SELECT auto.NO, auto.NAME, auto.FROMNODENO, auto.TONODENO, SUM(auto." . $field . ") AS POTOK
FROM auto GROUP BY auto.NO) AS flow on (xy.FROM = flow.FROMNODENO AND xy.TO = flow.TONODENO) OR (xy.FROM = flow.TONODENO AND xy.TO = flow.FROMNODENO)");
      $tracks = [];
//file_put_contents('d:\Usr\log\tracker\error.log', gettype($stmt));
    while ($row = $stmt->fetch()) {
        if ($row['INDEX'] == '1') {
            $obj = new Track($row['NAME'], $row['POTOK']);
            $tracks[] = $obj;
        } else {
            
        }
        $obj->addPoint($row['XCOORD'], $row['YCOORD']);
    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$pxK = (PX_MAX - PX_MIN) / (Track::$flowMax - Track::$flowMin);
$tracksAr = [];
foreach ($tracks as $value) {
    $tracksAr[] = $value->obj2arr();
}
$tracksAr['pxK'] = $pxK;

echo json_encode($tracksAr);
?>

