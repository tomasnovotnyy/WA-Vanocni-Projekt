<?php
// Načtení potřebných knihoven
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

// Definice tajného klíče pro JWT
define('SECRET_KEY', 'your-secret-key');

// Připojení k databázi
$db = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

// Získání metody HTTP požadavku
$method = $_SERVER['REQUEST_METHOD'];

// Získání cesty požadavku a odstranění lomítek na začátku a konci
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

// Získání těla požadavku a jeho dekódování z JSONu
$input = json_decode(file_get_contents('php://input'),true);

// Odstranění prefixu 'Bearer ' z JWT
$jwt = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);

// Dekódování JWT
try {
    $decoded = JWT::decode($jwt, SECRET_KEY, array('HS256'));
} catch (Exception $e) {
    // Pokud dekódování selže, vrátí se chyba 401 Unauthorized
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Zpracování požadavku podle metody HTTP
switch ($method) {
    case 'GET':
        // Zpracování GET požadavků
        switch ($request[0]) {
            case 'messages':
                // Zpracování požadavků na zprávy
                if (isset($request[1])) {
                    // Pokud je zadáno ID uživatele, vrátí se všechny zprávy tohoto uživatele
                    $stmt = $db->prepare('SELECT * FROM messages WHERE user_id = ?');
                    $stmt->execute([$request[1]]);
                } else {
                    // Pokud není zadáno ID uživatele, vrátí se všechny zprávy
                    $stmt = $db->prepare('SELECT * FROM messages');
                    $stmt->execute();
                }
                // Získání zpráv z databáze a jejich vrácení jako JSON
                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($messages);
                break;

            case 'chatrooms':
                // vracení všech zpráv vybrané chat room
                $stmt = $db->prepare('SELECT * FROM messages WHERE chatroom_id = ?');
                $stmt->execute([$request[1]]);
                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($messages);
                break;

            case 'search':
                // vracení všech zpráv obsahujících vybrané slovo (case insensetive)
                $stmt = $db->prepare('SELECT * FROM messages WHERE message LIKE ?');
                $stmt->execute(['%' . $request[1] . '%']);
                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($messages);
                break;
        }
        break;
}

// composer require firebase/php-jwt