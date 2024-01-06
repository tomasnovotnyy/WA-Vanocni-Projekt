<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $successNext = TRUE;
    $emailVisibility = FALSE;
    $file_name = 'data'. '.json';

    $current_data = file_get_contents("$file_name");
    $array = json_decode($current_data, TRUE);

    foreach ($array as $insecure_val) {
        if($insecure_val['email'] == $email && $insecure_val['email'] != '') {
            $emailVisibility = TRUE;
            if($insecure_val['password'] == $password && $insecure_val['password'] != ''){
                $successNext = FALSE;
                session_start();
                $_SESSION["email"]=$email;
                header("Location: /chat.php");
                break;
            }
        }header("Location: /index.php");
    }
}
 
?>