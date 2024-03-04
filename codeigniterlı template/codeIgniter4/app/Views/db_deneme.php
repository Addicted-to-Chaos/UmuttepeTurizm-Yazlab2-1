<?php

//home.php de connection'ı yapıp oradan sql sorgusuyla tablodan veri çekip buraya gönderiyor

//bu tüm tabloyu yazdırıyor
foreach ($veriler as $row) {
    foreach ($row as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }
    echo "-------------------<br>";
}

//bu da sadece belirtilen sütunu getiriyor email gibi mesela işte

foreach ($veriler as $row) {
    echo $row->Email . "<br>";
}

?>
