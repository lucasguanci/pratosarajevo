<?php

require 'lib/Slim/Slim.php';
require 'lib/Predis/Autoloader.php';

// $username = $r->get("aid:$aid:username");
// $limmagini = $r->llen("aid:$aid:immagini");
// for ( $i=0; $i<$limmagini; $i++ ) {
//   $img[$i] = $r->lindex("aid:$aid:immagini",$i);
//   echo $img[$i]."<br>";
// }

/* Slim */
\Slim\Slim::registerAutoloader();
$app = new Slim\Slim();
/* Predis */
Predis\Autoloader::register();
// $r = new Predis\Client();
// $aid = $r->get('global:nextArtistId');

$app->get('/artists','getArtists');
$app->get('/artists/:username','getArtist');
// -- $app->get('/artists/:aid','getArtistByAid');
// $app->post('/artists','addArtist');
// $app->put('/artists/:id','updateArtist');
// $app->delete('/artists/:id','deleteArtist');

$app->run();

function getArtists() {  
  try {
    redisConnect();
    $n = $r->get('global:nextArtistId');
    $aid = $r->get('global:nextArtistId');
    for ( $i=0; $i<$n; $i++ ) {
      $artist[$i] = $r->get("aid:$aid:username");    
      echo json_encode($artist);
    }
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getArtist($username) {
  try {
    $r = redisConnect();
    $aid = $r->get("username:$username:aid");
    //
    $immagini[] = array(); 
    for ( $i=0; $i<$r->llen("aid:$aid:immagini"); $i++ ) {
      $immagini[$i] = array(
        "url" => $r->lindex("aid:$aid:immagini",$i),
        "didascalia" => $r->lindex("aid:$aid:didascalie",$i)
      );  
    }
    $artist = array(
      "username"=> $r->get("aid:$aid:username"),
      "nome"=> $r->get("aid:$aid:nome"),
      "cognome"=> $r->get("aid:$aid:cognome"),
      "email"=> $r->get("aid:$aid:email"),
      "bio"=> $r->get("aid:$aid:bio"),
      "immagini"=> $immagini
    );
    header('Content-type: application/json');
    echo json_encode($artist);  
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getArtistByAid($aid) {
  try {
    $r = redisConnect();
    //
    $immagini[] = array(); 
    for ( $i=0; $i<$r->llen("aid:$aid:immagini"); $i++ ) {
      $immagini[$i] = array(
        "url" => $r->lindex("aid:$aid:immagini",$i),
        "didascalia" => $r->lindex("aid:$aid:didascalie",$i)
      );  
    }
    $artist = array(
      "username"=> $r->get("aid:$aid:username"),
      "nome"=> $r->get("aid:$aid:nome"),
      "cognome"=> $r->get("aid:$aid:cognome"),
      "email"=> $r->get("aid:$aid:email"),
      "bio"=> $r->get("aid:$aid:bio"),
      "immagini"=> $immagini
    );
    header('Content-type: application/json');
    echo json_encode($artist);  
  } catch (Exception $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}


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