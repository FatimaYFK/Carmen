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
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, telefonnummerization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get All reservieren
$app->get('/api/reservieren', function(Request $request, Response $response){

    //set header as json
    $response = $response->withHeader('Content-type', 'application/json');

    $sql = "SELECT * FROM reservieren";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $reservieren = $stmt->fetchAll(PDO::FETCH_OBJ);

        //close db connection
        $db = null;

        //write json as response
        return $response->write(json_encode($reservieren));

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Get Single reservation
$app->get('/api/reservation/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM reservieren WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $reservation = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $response->write(json_encode($reservation));
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Add reservation
$app->post('/api/reservation/add', function(Request $request, Response $response){
    $kundenname = $request->getParam('kundenname');
    $telefonnummer = $request->getParam('telefonnummer');
    $datum = $request->getParam('datum');
 

    $sql = "INSERT INTO reservieren (kundenname,telefonnummer,datum) VALUES
    (:kundenname,:telefonnummer,:datum)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':kundenname', $kundenname);
        $stmt->bindParam(':telefonnummer', $telefonnummer);
        $stmt->bindParam(':datum', $datum);

        $stmt->execute();
        $last_id = $db->lastInsertId();

        echo '{"notice": {"text": "reservation Added", "id": '.$last_id.' }}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Update reservation
$app->put('/api/reservation/update/{id}', function(Request $request, Response $response){
    $id = $request->getParam('id');
    $kundenname = $request->getParam('kundenname');
    $telefonnummer = $request->getParam('telefonnummer');
    $datum = $request->getParam('datum');

    $sql = "UPDATE reservieren SET
				kundenname 	= :kundenname,
				telefonnummer 	= :telefonnummer,
                datum	= :datum
			WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':kundenname', $kundenname);
        $stmt->bindParam(':telefonnummer', $telefonnummer);
        $stmt->bindParam(':datum', $datum);

        $stmt->execute();

        echo '{"notice": {"text": "reservation Updated"}}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Delete Customer
$app->delete('/api/reservation/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM reservieren WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "reservation Deleted"}}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Restes reservieren
$app->get('/api/reservieren/reset', function(Request $request, Response $response){

 

    $sql = "DELETE FROM reservieren; INSERT INTO reservieren(kundenname, telefonnummer, datum) VALUES
    ('The Outsider', 'Stephen King', 8),
    ('Fight Club', 'Chuck Palahniuk', 9),
    ('The Martian', 'Andy Weir', 7);";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo '{"notice": {"text": "reservieren Reset"}}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});
