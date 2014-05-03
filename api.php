<?php

require 'lib/Slim/Slim.php';
require 'lib/Predis/Autoloader.php';

/* Slim */
Slim\Slim::registerAutoloader();
$app = new Slim\Slim();

/* Predis */
Predis\Autoloader::register();

/* Artists */
$app->get('/artists','getArtists');
$app->get('/artists/:username','getArtist');
$app->post('/artists','addArtist');
$app->put('/artists/:username','updateArtist');
// $app->delete('/artists/:id','deleteArtist');

/* News */
$app->get('/news','getNews');
$app->get('/news/:id','getPost');
$app->post('/news','addPost');
$app->put('/news/:id','updatePost');
$app->delete('/news/:id','deletePost');

$app->run();


/**
 * artists API
 */
// GET /artists
function getArtists() {  
  $sql = "SELECT * FROM artists ORDER BY username";
  try {
    $db = mysqlConnect();
    $query = $db->query($sql);
    $result = $query->fetchall(PDO::FETCH_OBJ);
    $db = null;
    //header('Content-type: application/json');
    echo json_encode($result);
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// GET /artists/:id
function getArtist($username) {
  $sql = "SELECT * FROM artists WHERE username=:username";
  try {
    $db = mysqlConnect();
    $query = $db->prepare($sql);
    $query->bindParam("username",$username);
    $query->execute();
    $artist = $query->fetchObject();
    $db = null;
    // header('Content-type: application/json');
    echo json_encode($artist);  
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// POST /artists
function addArtist() {
  $request = Slim\Slim::getInstance()->request();
  $artist = json_decode($request->getBody());
  $sql = "INSERT INTO artists (username, nome, immagine_1, immagine_2, immagine_3, didascalia_1, didascalia_2, didascalia_3, bio) VALUES (:username, :nome, :immagine_1, :immagine_2, :immagine_3, :didascalia_1, :didascalia_2, :didascalia_3, :bio)";
  try {
    $db = mysqlConnect();
    $query = $db->prepare($sql);
    $query->bindParam("username", $artist->username);
    $query->bindParam("nome", $artist->nome);
    $query->bindParam("immagine_1", $artist->immagini[0]);
    $query->bindParam("immagine_2", $artist->immagini[1]);
    $query->bindParam("immagine_3", $artist->immagini[2]);
    $query->bindParam("didascalia_1", $artist->didascalie[0]);
    $query->bindParam("didascalia_2", $artist->didascalie[1]);
    $query->bindParam("didascalia_3", $artist->didascalie[2]);
    $query->bindParam("bio", $artist->bio);
    $query->execute();
    $artist->id = $db->lastInsertId();
    $db = null;
    echo json_encode($artist);    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// PUT /artists/:id
function updateArtist($username) {
  $request = Slim\Slim::getInstance()->request();
  $artist = json_decode($request->getBody());
  $sql = "UPDATE artists SET username=:username, nome=:nome, immagine_1=:immagine_1, immagine_2=:immagine_2, immagine_3=:immagine_3, didascalia_1=:didascalia_1, didascalia_2=:didascalia_2, didascalia_3=:didascalia_3, bio=:bio WHERE username=:username";
  try {
    $db = mysqlConnect();
    $query = $db->prepare($sql);
    $query->bindParam("username", $username);
    $query->bindParam("nome", $artist->nome);
    $query->bindParam("immagine_1", $artist->immagini[0]);
    $query->bindParam("immagine_2", $artist->immagini[1]);
    $query->bindParam("immagine_3", $artist->immagini[2]);
    $query->bindParam("didascalia_1", $artist->didascalie[0]);
    $query->bindParam("didascalia_2", $artist->didascalie[1]);
    $query->bindParam("didascalia_3", $artist->didascalie[2]);
    $query->bindParam("bio", $artist->bio);
    $query->bindParam("id", $artist->id);
    $query->execute();
    $db = null;
    echo json_encode($artist);    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'},"data":'.json_encode($artist).'}'; 
  }
}

/**
 * news API
 */
// GET /news
function getNews() {  
  $sql = "SELECT * FROM news ORDER BY id DESC";
  try {
    $db = mysqlConnect();
    $query = $db->query($sql);
    $result = $query->fetchall(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($result);
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// GET /news/:id
function getPost($id) {
  $sql = "SELECT * FROM news WHERE id=:id";
  try {
    $db = mysqlConnect();
    $query = $db->prepare($sql);
    $query->bindParam("id",$id);
    $query->execute();
    $post = $query->fetchObject();
    $db = null;
    echo json_encode($post);  
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// POST /news
function addPost() {
  $request = Slim\Slim::getInstance()->request();
  $post = json_decode($request->getBody());
  $sql = "INSERT INTO news (data, data_pubblicazione, titolo, contenuto, immagine) VALUES (:data, :data_pubblicazione, :titolo, :contenuto, :immagine, :target, :testo_esteso, :in_evidenza, :categoria)";
  try {
    $db = mysqlConnect();
    $query = $db->prepare($sql);
    $query->bindParam("data", $post->data);
    $query->bindParam("data_pubblicazione", $post->data_pubblicazione);
    $query->bindParam("titolo", $post->titolo);
    $query->bindParam("contenuto", $post->contenuto);
    $query->bindParam("immagine", $post->immagine);
    $query->bindParam("target", $post->target);
    $query->bindParam("testo_esteso", $post->testo_esteso);
    $query->bindParam("in_evidenza", $post->in_evidenza);
    $query->bindParam("categoria", $post->categoria);
    $query->execute();
    $post->id = $db->lastInsertId();
    $db = null;
    echo json_encode($post);    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// UPDATE /news/:id
function updatePost($id) {
  $request = Slim\Slim::getInstance()->request();
  $post = json_decode($request->getBody());
  $sql = "UPDATE news SET data_pubblicazione=:data_pubblicazione, titolo=:titolo, contenuto=:contenuto, immagine=:immagine, target=:target, testo_esteso=:testo_esteso, in_evidenza=:in_evidenza, categoria=:categoria WHERE id=:id";
  try {
    $db = mysqlConnect();
    $query = $db->prepare($sql);
    $query->bindParam("data_pubblicazione", $post->data_pubblicazione);
    $query->bindParam("titolo", $post->titolo);
    $query->bindParam("contenuto", $post->contenuto);
    $query->bindParam("immagine", $post->immagine);
    $query->bindParam("target", $post->target);
    $query->bindParam("testo_esteso", $post->testo_esteso);
    $query->bindParam("in_evidenza", $post->in_evidenza);
    $query->bindParam("categoria", $post->categoria);
    $query->bindParam("id", $id);
    $query->execute();
    $db = null;
    echo json_encode($post);    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// DELETE /news/:id
function deletePost($id) {
  $request = Slim\Slim::getInstance()->request();
  $post = json_decode($request->getBody());
  try {
    $r = redisConnect();
    $r->del("post:$id");
    echo '{"success":"deleted post post:$id"}';    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}


/**
 * DB Connection
 */
// Connect to MySQL
function mysqlConnect() {
  $dbhost="127.0.0.1";
  $dbuser="root";
  $dbpass="coyote";
  $dbname="ps";
  // $dbhost="62.149.150.136";
  // $dbuser="Sql476706";
  // $dbpass="1936974d";
  // $dbname="Sql476706_3";
  $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $dbh;
}

// Connect to Redis 
function redisConnect() {
  // redis to go
  // redis://redistogo:b31db3a22b6e0fa1bde8b9e829a7d8ee@albacore.redistogo.com:10547/
  $password='b31db3a22b6e0fa1bde8b9e829a7d8ee';
  $host="albacore.redistogo.com";
  $port= 10547;

  $r = new Predis\Client(
    array
      (
        'scheme' => 'tcp',
        'host' => $host,
        'port' => $port,
        'password' => $password
      )
  );
  // local
  // $r = new Predis\Client();
  return $r;
}

?>