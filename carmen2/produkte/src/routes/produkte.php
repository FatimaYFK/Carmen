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
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, lagerbestandization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

// Get All produkte
$app->get('/api/produkte', function(Request $request, Response $response){

    //set header as json
    $response = $response->withHeader('Content-type', 'application/json');

    $sql = "SELECT * FROM produkte";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $produkte = $stmt->fetchAll(PDO::FETCH_OBJ);

        //close db connection
        $db = null;

        //write json as response
        return $response->write(json_encode($produkte));

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Get Single produkt
$app->get('/api/produkt/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM produkte WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $produkt = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $response->write(json_encode($produkt));
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Add produkt
$app->post('/api/produkt/add', function(Request $request, Response $response){
    $kaffee = $request->getParam('kaffee');
    $lagerbestand = $request->getParam('lagerbestand');
    $preis = $request->getParam('preis');
 

    $sql = "INSERT INTO produkte (kaffee,lagerbestand,preis) VALUES
    (:kaffee,:lagerbestand,:preis)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':kaffee', $kaffee);
        $stmt->bindParam(':lagerbestand', $lagerbestand);
        $stmt->bindParam(':preis', $preis);

        $stmt->execute();
        $last_id = $db->lastInsertId();

        echo '{"notice": {"text": "produkt Added", "id": '.$last_id.' }}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Update produkt
$app->put('/api/produkt/update/{id}', function(Request $request, Response $response){
    $id = $request->getParam('id');
    $kaffee = $request->getParam('kaffee');
    $lagerbestand = $request->getParam('lagerbestand');
    $preis = $request->getParam('preis');

    $sql = "UPDATE produkte SET
				kaffee 	= :kaffee,
				lagerbestand 	= :lagerbestand,
                preis	= :preis
			WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':kaffee', $kaffee);
        $stmt->bindParam(':lagerbestand', $lagerbestand);
        $stmt->bindParam(':preis', $preis);

        $stmt->execute();

        echo '{"notice": {"text": "produkt Updated"}}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Delete Customer
$app->delete('/api/produkt/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM produkte WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "produkt Deleted"}}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});