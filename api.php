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
// -- $app->get('/artists/:aid','getArtistByAid');
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
  try {
    $r = redisConnect();
    $n = $r->get('global:nextArtistId');
    $artist = array(); 
    for ( $i=0; $i<$n; $i++ ) {
      $aid = $i+1;
      $artist[$i] = $r->get("aid:$aid:username");          
    }
    //header('Content-type: application/json');
    echo json_encode($artist);
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// GET /artists/:username
function getArtist($username) {
  try {
    $r = redisConnect();
    $aid = $r->get("username:$username:aid");
    //
    $immagini[] = array();     
    for ( $i=0; $i<$r->llen("aid:$aid:immagini"); $i++ ) {
      $immagini[$i] = $r->lindex("aid:$aid:immagini",$i);
    }
    $didascalie[] = array();
    for ( $i=0; $i<$r->llen("aid:$aid:immagini"); $i++ ) {
      $didascalie[$i] = $r->lindex("aid:$aid:didascalie",$i);
    }
    $artist = array(
      "username"=> $r->get("aid:$aid:username"),
      "nome"=> $r->get("aid:$aid:nome"),
      "cognome"=> $r->get("aid:$aid:cognome"),
      "email"=> $r->get("aid:$aid:email"),
      "bio"=> $r->get("aid:$aid:bio"),
      "immagini" => $immagini,
      "didascalie" => $didascalie
    );
    header('Content-type: application/json');
    echo json_encode($artist);  
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// POST /artists
function addArtist() {
  $request = Slim\Slim::getInstance()->request();
  $artist = json_decode($request->getBody());
  try {
    $r = redisConnect();
    $r->incr('global:nextArtistId');
    $aid = $r->get('global:nextArtistId');
    $username = $artist->username;
    $r->set("username:$username:aid", $aid);
    $r->set("aid:$aid:username",$artist->username);
    $r->set("aid:$aid:nome",$artist->nome);
    $r->set("aid:$aid:bio",$artist->bio);
    $l = sizeof($artist->immagini);
    for ( $i=0; $i<$l; $i++ ) {
      $r->rpush("aid:$aid:immagini", $artist->immagini[$i]);
      $r->rpush("aid:$aid:didascalie", $artist->didascalie[$i]);
    }
    echo json_encode($artist);    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// PUT /artists/:username
function updateArtist($username) {
  $request = Slim\Slim::getInstance()->request();
  $artist = json_decode($request->getBody());
  try {
    $r = redisConnect();
    $aid = $r->get("username:$username:aid");
    $r->set("aid:$aid:username",$artist->username);
    $r->set("aid:$aid:nome",$artist->nome);
    $r->set("aid:$aid:bio",$artist->bio);
    $l = sizeof($artist->immagini); // 3
    for ( $i=0; $i<$l; $i++ ) {
      if ( $r->lindex("aid:$aid:immagini", $i) !== null ) {
        $r->lset("aid:$aid:immagini", $i, $artist->immagini[$i]);  
      } else {
        $r->rpush("aid:$aid:immagini", $artist->immagini[$i]);
      }
      if ( $r->lindex("aid:$aid:didascalie", $i) !== null ) {
        $r->lset("aid:$aid:didascalie", $i, $artist->didascalie[$i]);  
      } else {
        $r->rpush("aid:$aid:didascalie", $artist->didascalie[$i]);
      }      
    }
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
  try {
    $r = redisConnect();
    // number of news
    $N = 4;
    $news = $r->lrange("news",0,$N-1);
    //header('Content-type: application/json');
    echo json_encode($news);
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getPost($id) {
  try {
    $r = redisConnect();
    $post = array(
      "id" => $r->hget("post:$id","id"),
      "data" => $r->hget("post:$id","data"),
      "titolo" => $r->hget("post:$id","titolo"),
      "contenuto" => $r->hget("post:$id","contenuto"),
      "immagine" => $r->hget("post:$id","immagine")
    );
    header('Content-type: application/json');
    echo json_encode($post);  
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// POST /news
function addPost() {
  $request = Slim\Slim::getInstance()->request();
  $post = json_decode($request->getBody());
  try {
    $r = redisConnect();
    $r->incr('global:nextPostId');
    $id = $r->get("global:nextPostId");
    $r->hmset("post:$id", array(
      "id" => $id,
      "data" => $post->data,
      "titolo" => $post->titolo,
      "contenuto" => $post->contenuto,
      "immagine" => $post->immagine
      )
    );
    $r->lpush("news","post:$id");
    echo json_encode($post);    
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// UPDATE /news/:id
function updatePost($id) {
  $request = Slim\Slim::getInstance()->request();
  $post = json_decode($request->getBody());
  try {
    $r = redisConnect();
    $r->hmset("post:$id", array(
      "id" => $id,
      "data" => $post->data,
      "titolo" => $post->titolo,
      "contenuto" => $post->contenuto,
      "immagine" => $post->immagine
      )
    );
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