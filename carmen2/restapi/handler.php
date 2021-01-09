<?php
    $conn = new mysqli('localhost','root', '', 'carmen');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $sql = $conn->query("SELECT kaffee, preis, lagerbestand FROM produkte WHERE id='$id'");
            $data = $sql->fetch_assoc();
        } else {
            $data = array();
            $sql = $conn->query("SELECT kaffee, preis, lagerbestand FROM produkte");
            while ($d = $sql->fetch_assoc())
                $data[] = $d;
        }

        exit(json_encode($data));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['kaffee']) && isset($_POST['preis'])) {
            $kaffee = $conn->real_escape_string($_POST['kaffee']);
            $preis = $conn->real_escape_string($_POST['preis']);
            $lagerbestand = $conn->real_escape_string($_POST['lagerbestand']);

            $conn->query("INSERT INTO produkte (kaffee,preis,lagerbestand) VALUES ('$kaffee', '$preis', '$lagerbestand')");
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

            if (isset($allPairs['kaffee']) && isset($allPairs['preis']) && isset($allPairs['lagerbestand'])) {
                $conn->query("UPDATE produkte SET preis='".$allPairs['preis']."', kaffee='".$allPairs['kaffee']."', lagerbestand='".$allPairs['lagerbestand']."' WHERE id='$produktID'");
            } else if (isset($allPairs['kaffee'])) {
                $conn->query("UPDATE produkte SET kaffee='".$allPairs['kaffee']."' WHERE id='$produktID'");
            } else if (isset($allPairs['preis'])) {
                $conn->query("UPDATE produkte SET preis='".$allPairs['preis']."' WHERE id='$produktID'");
            } else if (isset($allPairs['preis'])) {
                $conn->query("UPDATE produkte SET lagerbestand='".$allPairs['lagerbestand']."' WHERE id='$produktID'");
            } else
                exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

            exit(json_encode(array("status" => 'success')));
        } else
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        if (!isset($_GET['id']))
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

        $produktID = $conn->real_escape_string($_GET['id']);
        $conn->query("DELETE FROM produkte WHERE id='$produktID'");
        exit(json_encode(array("status" => 'success')));
    }
?>