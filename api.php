  <?php

require 'lib/Slim/Slim.php';
require 'lib/Predis/Autoloader.php';

/* Slim */
Slim\Slim::registerAutoloader();
$app = new Slim\Slim();

/* Predis */
Predis\Autoloader::register();

$app->get('/artists','getArtists');
$app->get('/artists/:username','getArtist');
// -- $app->get('/artists/:aid','getArtistByAid');
$app->post('/artists','addArtist');
$app->put('/artists/:username','updateArtist');
// $app->delete('/artists/:id','deleteArtist');

$app->run();

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


//updateArtist("banchelli");

// PUT /artists/:username
function updateArtist($username) {
  $request = Slim\Slim::getInstance()->request();
  $artist = json_decode($request->getBody());
  //  $data = '{"username": "banchelli", "nome": "Francesca Banchelli", "immagini": ["img-1", "img-2", "img-3"], "didascalie": ["didascalia-1", "didascalia-2", "didascalia-3"], "bio": "biografia banchelli"}';
  //  echo "encoded: $data<br>";
  // $artist = json_decode($data);
  // var_dump($artist);
  // echo "username: $artist->username<br>";
  // echo "img[2]: ".$artist->immagini[1]."<br>";
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