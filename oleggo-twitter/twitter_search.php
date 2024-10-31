<?php

  $q = rawurlencode($_REQUEST['q']);

  $url = "http://search.twitter.com/search.json?q=$q";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  curl_setopt($ch, CURLOPT_NOBODY, 0);
  curl_setopt($ch, CURLOPT_HEADER, false);

  $response = curl_exec($ch);
  curl_close($ch);

  echo $response;
  
?>