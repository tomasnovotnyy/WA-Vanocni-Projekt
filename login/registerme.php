<?php 

// Funkce pro získání dat
function get_data() {
    // Název souboru s daty
    $file_name = 'data.json';

    // Hashování hesla
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Kontrola, zda soubor s daty existuje
    if(file_exists("$file_name")) { 
        // Načtení aktuálních dat ze souboru
        $current_data = file_get_contents("$file_name");

        // Převedení dat z JSONu do pole
        $array_data = json_decode($current_data, true);

        // Procházení pole s daty
        foreach ($array_data as $user) {
            // Kontrola, zda se email uživatele nachází v datech
            if ($user['email'] == $_POST['email']) {
                return false;
            }
        }
                           
        // Přidání nového uživatele do pole
        $extra = array(
            'email' => $_POST['email'],
            'password' => $hashed_password,
        );
        $array_data[]=$extra;

        // Převedení pole zpět do JSONu
        return json_encode($array_data);
    }
    else {
        // Pokud soubor s daty neexistuje, vytvoření nového pole s uživatelem
        $datae=array();
        $datae[]=array(
            'email' => $_POST['email'],
            'password' => $hashed_password,
        );

        // Převedení pole do JSONu
        return json_encode($datae);   
    }
}

// Kontrola, zda byla stránka načtena pomocí POST metody
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Získání emailu z POST dat
    $email = $_POST['email'];

    // Název souboru s daty
    $file_name = 'data.json';

    // Získání dat
    $data = get_data();

    // Kontroluje, zda byla data úspěšně získána.
    if ($data) {
        // Pokud ano, pokusí se data zapsat do souboru.
        if(file_put_contents("$file_name", $data)) {
            // Pokud se data úspěšně zapíšou do souboru, spustí se session, email se uloží do session a dojde k přesměrování na index.php.
            session_start();
            $_SESSION["email"]=$email;
            header("Location: /index.php");
        }                
        else {
            // Pokud se data do souboru nezapišou úspěšně, vypíše se chybová zpráva.
            echo 'Došlo k nějaké chybě';                
        }
    } else {
        // Pokud nebyla data úspěšně získána (tj. email již existuje), vypíše se jiná chybová zpráva.
        echo 'Email již existuje';
    }
}    

?>
