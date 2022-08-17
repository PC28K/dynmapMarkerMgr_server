<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400');
    header('Access-Control-Allow-Headers: x-requested-with');
    header('Access-Control-Allow-Methods: GET, POST');

    //API랑 통신에서 쓸 암호
    $key = '';
    //마커 JSON파일 경로
    $json = '';



    $output = '';
    try{
        if($_GET['k'] == $key){
            if($_GET['q'] == 'list'){
                header("HTTP/1.1 200");
                $output = file_get_contents($json);
                echo 'cb('.$output.');';
            }
            else if($_GET['q'] == 'push'){
                header("HTTP/1.1 200");
                $file = fopen($json, "w");
                fwrite($file, $_POST['data']);
                fclose($file);
            }
            else{
                header("HTTP/1.1 400");
                echo '잘못된 요청';
            }
        }
        else{
            header("HTTP/1.1 403");
            echo '키 불일치';
        }
    }
    catch(Exception $e){
        header("HTTP/1.1 500");
        echo '처리 오류';
    }
    
?>