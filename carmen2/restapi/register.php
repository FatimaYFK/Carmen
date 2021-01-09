<?php
    $conn = new mysqli('localhost','root', '', 'carmen');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $sql = $conn->query("SELECT user_name, user_email, user_password FROM register_user WHERE id='$id'");
            $data = $sql->fetch_assoc();
        } else {
            $data = array();
            $sql = $conn->query("SELECT user_name, user_email, user_password FROM register_user");
            while ($d = $sql->fetch_assoc())
                $data[] = $d;
        }

        exit(json_encode($data));
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['user_name']) && isset($_POST['user_email'])) {
            $user_name = $conn->real_escape_string($_POST['user_name']);
            $user_email = $conn->real_escape_string($_POST['user_email']);
            $user_password = $conn->real_escape_string($_POST['user_password']);

            $conn->query("INSERT INTO register_user (user_name,user_email,user_password) VALUES ('$user_name', '$user_email', '$user_password')");
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

            if (isset($allPairs['user_name']) && isset($allPairs['user_email']) && isset($allPairs['user_password'])) {
                $conn->query("UPDATE register_user SET user_email='".$allPairs['user_email']."', user_name='".$allPairs['user_name']."', user_password='".$allPairs['user_password']."' WHERE id='$produktID'");
            } else if (isset($allPairs['user_name'])) {
                $conn->query("UPDATE register_user SET user_name='".$allPairs['user_name']."' WHERE id='$produktID'");
            } else if (isset($allPairs['user_email'])) {
                $conn->query("UPDATE register_user SET user_email='".$allPairs['user_email']."' WHERE id='$produktID'");
            } else if (isset($allPairs['user_email'])) {
                $conn->query("UPDATE register_user SET user_password='".$allPairs['user_password']."' WHERE id='$produktID'");
            } else
                exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

            exit(json_encode(array("status" => 'success')));
        } else
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));
    } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        if (!isset($_GET['id']))
            exit(json_encode(array("status" => 'failed', 'reason' => 'Check Your Inputs')));

        $produktID = $conn->real_escape_string($_GET['id']);
        $conn->query("DELETE FROM register_user WHERE id='$produktID'");
        exit(json_encode(array("status" => 'success')));
    }
?>