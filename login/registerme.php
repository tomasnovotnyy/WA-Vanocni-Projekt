<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $successNext = TRUE;
    $emailVisibility = FALSE;
    $file_name = 'data'. '.json';

    $current_data = file_get_contents("$file_name");
    $array = json_decode($current_data, TRUE);    
    
    function get_data() {
        $email = $_POST['email'];
        $file_name='data'. '.json';
   
        if(file_exists("$file_name")) { 
            $current_data = file_get_contents("$file_name");
            $array_data = json_decode($current_data, true);
                               
            $extra = array(
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            );
            $array_data[]=$extra;
            return json_encode($array_data);
        }
        else {
            $datae=array();
            $datae[]=array(
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            );
            return json_encode($datae);   
        }
    }
      
    if($successNext && $emailVisibility == FALSE){
        if(file_put_contents("$file_name", get_data())) {
            session_start();
            $_SESSION["email"]=$email;
            header("Location: /index.php");
        }                
        else {
            echo 'There is some error';                
        }
    }    
}
?>