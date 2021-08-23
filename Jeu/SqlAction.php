<?php
require_once('../Core/init.php');
init_session();
$db=DataBase::getInstance();
$user=new Users();


if($_POST['action'] == 'getPhotos')
{
  $photo= $db->SelectAll('photos');
    echo json_encode($photo);
}

else if($_POST['action'] == 'getTags')
{
  $tag= $db->SelectAll('tags');
  echo json_encode($tag);
}

/*if(isset($_POST['name']) && isset($_POST['photoid')
{
$db->Insert('tags', array('name'=>$_POST['name']),
  'photoid'=>$_POST['photoid'],
  'originaltag'=>0);
}*/

if(isset($_POST['scores'])){
$db->Insert('scores',array('pseudo'=>$user->data()->pseudo,
'score'=>$_POST['scores']));

}


if(isset($_GET['tag'])) {

    $params=['method'=>'flickr.photos.search',
    'api_key'=>'04d14a5e92b64869b55d6818e514284a',
    'tags'=>$_GET['tag'],
    'per_page'=>'50',
    'sort'=>'relevance',
    'format'=>'json',
    'nojsoncallback'=>'1'];
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://www.flickr.com/services/rest/');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = json_decode(curl_exec($ch));
    $photos = $output->photos->photo;

    foreach ($photos as $photo) {
        $params=['method'=>'flickr.photos.getInfo',
        'api_key'=>'04d14a5e92b64869b55d6818e514284a',
        'photo_id'=>$photo->id,
        'format'=>'json',
        'nojsoncallback'=>'1'];

        curl_setopt($ch, CURLOPT_URL, 'https://www.flickr.com/services/rest/');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = json_decode(curl_exec($ch));

        $photo = $output->photo;
        $url = 'https://farm'.$photo->farm.'.staticflickr.com/'.$photo->server.'/'.$photo->id.'_'.$photo->secret.'.jpg';

        if(count($photo->tags->tag)>=5) {
            $rq = 'INSERT INTO photos (url) VALUES (:url)';
            $stmt = $bd->prepare($rq);
            $data = array(':url' => $url);
            $stmt->execute($data);

            $rq = 'SELECT id FROM photos WHERE url=:url';
            $stmt = $bd->prepare($rq);
            $data = array(':url' => $url);
            $stmt->execute($data);
            $photo_id = $stmt->fetch()['id'];

            foreach ($photo->tags->tag as $tag) {
                $rq = 'INSERT INTO tags (name, photoid) VALUES (:name, :photoid)';
                $stmt = $bd->prepare($rq);
                $data = array(':name' => $tag->_content, ':photoid' => $photo_id);
                $stmt->execute($data);
            }
        }
    }

    curl_close($ch);
}





 ?>
