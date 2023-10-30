<?php

    use Coco\encrypt\Encrypt;

    require '../vendor/autoload.php';

    $key = '123456789';

    $str = 'hello 你好 123456789';

    $s = Encrypt::encrypt($str, $key);

    echo $s;
    echo PHP_EOL;

    $result = Encrypt::decrypt($s, $key);

     var_dump($result);
    echo PHP_EOL;

    //22827c05c0dff0e3b50504d217dbe3c7fc2f382a747bdbeb70318d07fcd1c36c
    //string(22) "hello 你好 123456789"