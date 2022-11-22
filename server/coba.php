<?php
function get_CURL($url)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($curl);
  curl_close($curl);

  return json_decode($result, true);
}


$result = get_CURL('http://10.96.7.227/api/mestakung/realtime?key_device=3fb6f06bde851d7a88319ef2acb9441e&key=35e95974ac0aefc15c372aadf5f3eeee');
// $result= get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCozZHxh4ZSWpZ8emSBj07lw&key=AIzaSyAYdFxQnfEC2TPchSUbJcMaV VAKaZWXhzw');

// $ytpp = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
// $namayt= $result['items'][0]['snippet']["title"];
// $subs = $result['items'][0]['statistics']["subscriberCount"];
print_r($result);
