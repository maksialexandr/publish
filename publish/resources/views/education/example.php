<div style="float:right; color:#1E90FF; font-size:14pt;background: #f5fafd; "><?php

    $morning = "Доброе утро!<br />Рады Вас видеть!<br />";
    $day = "Добрый день!<br />Рады Вас видеть!<br />";
    $evening = "Добрый вечер!<br />Рады Вас видеть!<br />";
    $night = "Доброй ночи!<br />Рады Вас видеть!<br />";

    $minyt = date("i");
    $chasov = date("H");

    if($chasov >= 04) {$hello = $morning;}
    if($chasov >= 10) {$hello = $day;}
    if($chasov >= 16) {$hello = $evening;}
    if($chasov >= 22 or $chasov < 04) {$hello = $night;}

    echo $hello;
    echo "Сегодня - ".date("d-m-Y")."<br />";
    echo "Время на сайте: $chasov:$minyt" . '<br />';
    ?>

</div>