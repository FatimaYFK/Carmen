<?php
// creating API routed
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, mengeization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get All bestellungen
$app->GET('/api/bestellungen', function(Request $request, Response $response){

    //set header as json
    $response = $response->withHeader('Content-type', 'application/json');

    $sql = "SELECT * FROM bestellungen";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bestellungen = $stmt->fetchAll(PDO::FETCH_OBJ);

        //close db connection
        $db = null;

        //write json as response
        return $response->write(json_encode($bestellungen));

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Get Single bestellung
$app->GET('/api/bestellung/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM bestellungen WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bestellung = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $response->write(json_encode($bestellung));
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Add bestellung
$app->POST('/api/bestellung/add', function(Request $request, Response $response){
    $kundenname = $request->getParam('kundenname');
    $menge = $request->getParam('menge');
    $kundenadresse = $request->getParam('kundenadresse');
 

    $sql = "INSERT INTO bestellungen (kundenname,menge,kundenadresse) VALUES
    (:kundenname,:menge,:kundenadresse)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':kundenname', $kundenname);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':kundenadresse', $kundenadresse);

        $stmt->execute();
        $last_id = $db->lastInsertId();

        echo '{"notice": {"text": "bestellung Added", "id": '.$last_id.' }}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Update bestellung
$app->PUT('/api/bestellung/update/{id}', function(Request $request, Response $response){
    $id = $request->getParam('id');
    $kundenname = $request->getParam('kundenname');
    $menge = $request->getParam('menge');
    $kundenadresse = $request->getParam('kundenadresse');

    $sql = "UPDATE bestellungen SET
				kundenname 	= :kundenname,
				menge 	= :menge,
                kundenadresse	= :kundenadresse
			WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':kundenname', $kundenname);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':kundenadresse', $kundenadresse);

        $stmt->execute();

        echo '{"notice": {"text": "bestellung Updated"}}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Delete Customer
$app->DELETE('/api/bestellung/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM bestellungen WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "bestellung Deleted"}}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});