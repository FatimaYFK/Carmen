<?php
    $conn = new mysqli('localhost','root', '', 'carmen');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $sql = $conn->query("SELECT kundenname, menge, kundenadresse FROM bestellungen WHERE id='$id'");
            $data = $sql->fetch_assoc();
        } else {
            $data = array();
            $sql = $conn->query("SELECT kundenname, menge, kundenadresse FROM bestellungen");
            while ($d = $sql->fetch_assoc())
                $data[] = $d;
        }

        exit(json_encode($data));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['kundenname']) && isset($_POST['menge'])) {
            $kundenname = $conn->real_escape_string($_POST['kundenname']);
            $menge = $conn->real_escape_string($_POST['menge']);
            $kundenadresse = $conn->real_escape_string($_POST['kundenadresse']);

            $conn->query("INSERT INTO bestellungen (kundenname,menge,kundenadresse) VALUES ('$kundenname', '$menge', '$kundenadresse')");
            exit(json_encode(array("status" => 'success')));
        } else
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));
    } else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        if (!isset($_GET['id']))
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

        $produktID = $conn->real_escape_string($_GET['id']);
        $data = urldecode(file_get_contents('php://input'));

        if (strpos($data, '=') !== false) {
            $allPairs = array();
            $data = explode('&', $data);
            foreach($data as $pair) {
                $pair = explode('=', $pair);
                $allPairs[$pair[0]] = $pair[1];
            }

            if (isset($allPairs['kundenname']) && isset($allPairs['menge']) && isset($allPairs['kundenadresse'])) {
                $conn->query("UPDATE bestellungen SET menge='".$allPairs['menge']."', kundenname='".$allPairs['kundenname']."', kundenadresse='".$allPairs['kundenadresse']."' WHERE id='$produktID'");
            } else if (isset($allPairs['kundenname'])) {
                $conn->query("UPDATE bestellungen SET kundenname='".$allPairs['kundenname']."' WHERE id='$produktID'");
            } else if (isset($allPairs['menge'])) {
                $conn->query("UPDATE bestellungen SET menge='".$allPairs['menge']."' WHERE id='$produktID'");
            } else if (isset($allPairs['menge'])) {
                $conn->query("UPDATE bestellungen SET kundenadresse='".$allPairs['kundenadresse']."' WHERE id='$produktID'");
            } else
                exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

            exit(json_encode(array("status" => 'success')));
        } else
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        if (!isset($_GET['id']))
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

        $produktID = $conn->real_escape_string($_GET['id']);
        $conn->query("DELETE FROM bestellungen WHERE id='$produktID'");
        exit(json_encode(array("status" => 'success')));
    }
?>