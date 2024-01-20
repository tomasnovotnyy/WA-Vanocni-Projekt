<?php 

// Kontrola, zda byla stránka načtena pomocí POST metody
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   
    // Získání emailu a hesla z POST dat
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Inicializace proměnných pro kontrolu úspěšnosti přihlášení
    $successNext = TRUE;
    $emailVisibility = FALSE;

    // Název souboru s daty
    $file_name = 'data'. '.json';

    // Načtení aktuálních dat ze souboru
    $current_data = file_get_contents("$file_name");

    // Převedení dat z JSONu do pole
    $array = json_decode($current_data, TRUE);

    // Procházení pole s daty
    foreach ($array as $insecure_val) {

        // Kontrola, zda se email nachází v datech a není prázdný
        if($insecure_val['email'] == $email && $insecure_val['email'] != '') {
            $emailVisibility = TRUE;

            // Kontrola, zda heslo odpovídá hashi v datech a není prázdné
            if(password_verify($password, $insecure_val['password']) && $insecure_val['password'] != ''){
                $successNext = FALSE;

                // Zahájení session a uložení emailu do session
                session_start();
                $_SESSION["email"]=$email;

                // Přesměrování na chat.php
                header("Location: /chat.php");
                break;
            }
        }
    }

    // Pokud se nepodařilo přihlásit, přesměrování na index.php
    if($successNext){
        header("Location: /index.php");
    }
}
 
?>
