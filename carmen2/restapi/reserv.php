<?php
    $conn = new mysqli('localhost','root', '', 'carmen');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $sql = $conn->query("SELECT kundenname, telefonnummer, datum FROM reservieren WHERE id='$id'");
            $data = $sql->fetch_assoc();
        } else {
            $data = array();
            $sql = $conn->query("SELECT kundenname, telefonnummer, datum FROM reservieren");
            while ($d = $sql->fetch_assoc())
                $data[] = $d;
        }

        exit(json_encode($data));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['kundenname']) && isset($_POST['telefonnummer'])) {
            $kundenname = $conn->real_escape_string($_POST['kundenname']);
            $telefonnummer = $conn->real_escape_string($_POST['telefonnummer']);
            $datum = $conn->real_escape_string($_POST['datum']);

            $conn->query("INSERT INTO reservieren (kundenname,telefonnummer,datum) VALUES ('$kundenname', '$telefonnummer', '$datum')");
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

            if (isset($allPairs['kundenname']) && isset($allPairs['telefonnummer']) && isset($allPairs['datum'])) {
                $conn->query("UPDATE reservieren SET telefonnummer='".$allPairs['telefonnummer']."', kundenname='".$allPairs['kundenname']."', datum='".$allPairs['datum']."' WHERE id='$produktID'");
            } else if (isset($allPairs['kundenname'])) {
                $conn->query("UPDATE reservieren SET kundenname='".$allPairs['kundenname']."' WHERE id='$produktID'");
            } else if (isset($allPairs['telefonnummer'])) {
                $conn->query("UPDATE reservieren SET telefonnummer='".$allPairs['telefonnummer']."' WHERE id='$produktID'");
            } else if (isset($allPairs['telefonnummer'])) {
                $conn->query("UPDATE reservieren SET datum='".$allPairs['datum']."' WHERE id='$produktID'");
            } else
                exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

            exit(json_encode(array("status" => 'success')));
        } else
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        if (!isset($_GET['id']))
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

        $produktID = $conn->real_escape_string($_GET['id']);
        $conn->query("DELETE FROM reservieren WHERE id='$produktID'");
        exit(json_encode(array("status" => 'success')));
    }
?>