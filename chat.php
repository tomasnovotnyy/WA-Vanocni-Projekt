<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ChatZone</title>
  <link rel="icon" type="image/x-icon" href="img/Favicon/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @font-face {
            font-family: "Warfare";
            src: url("fonts/ModernWarfare.ttf");
        }

        body {
            padding-top: 80px;
            font-family: "Warfare", sans-serif;
        }

        header {
            font-family: "Warfare", sans-serif;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
        }

        .navbar-brand img {
            max-height: 30px;
        }

        .navbar-nav li a:hover {
            background-color: green;
            color: black;
        }

        #blackText {
            color: black;
        }

        #redText {
            color: green;
        }




    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
    }
    
    .chat-container {
      width: 50%;
      height: 100%;
      border-right: 1px solid #ccc;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
    }
    
    .chat-messages {
      flex: 1;
      overflow-y: auto;
      padding: 10px;
    }
    
    .message {
      background-color: #f2f2f2;
      padding: 8px 12px;
      margin-bottom: 8px;
      border-radius: 8px;
      max-width: 70%;
    }
    
    .message.sender {
      align-self: flex-end;
      background-color: #dcf8c6;
    }
    
    .message.other {
      align-self: flex-start;
      background-color: #ffc107; /* Barva pozadí pro druhou stranu */
    }
    
    .message-input {
      width: calc(100% - 20px); /* Šířka inputu - 20px padding */
      margin: 10px;
      padding: 10px;
      border: none;
      outline: none;
    }
    
    .send-button {
      margin: 0 10px 10px; /* Horní, pravý a dolní margin */
      padding: 10px 20px;
      background-color: green;
      color: #fff;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body style="padding-top: 80px;" class="bg-dark">
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-3" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="img/Logo/logo2.png" alt="logo"><span
                        id="blackText">Chat</span><span id="redText">Zone</span></a>
                <!-- Přidání třídy ms-auto pro tlačítko "Logout" -->
                <div class="ms-auto">
                    <?php
                        if(!isset($_SESSION['email'])){
                    ?>
                    <a href="login.php"><button class="btn btn-success loginbtn" id="loginbtn">Login</button></a>
                    <?php
                        }else{
                    ?>
                    <a href="logout.php"><button class="btn btn-success loginbtn" id="loginbtn">Logout</button></a>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
    </header>


  <div class="chat-container">
    <div class="chat-messages" id="chatMessages1">
      <!-- Zde se budou zobrazovat zprávy prvního uživatele -->
    </div>
    <div>
      <input type="text" class="message-input" placeholder="Napište zprávu..." id="userMessage1">
      <button class="send-button" onclick="sendMessage('1')">Odeslat</button>
    </div>
  </div>
  <div class="chat-container">
    <div class="chat-messages" id="chatMessages2">
      <!-- Zde se budou zobrazovat zprávy druhého uživatele -->
    </div>
    <div>
      <input type="text" class="message-input" placeholder="Napište zprávu..." id="userMessage2">
      <button class="send-button" onclick="sendMessage('2')">Odeslat</button>
    </div>
  </div>

  <script>
    /**
     * Odešle zprávu od uživatele do chatu.
     *
     * @param {string} chatId - ID chatu, do kterého se má zpráva odeslat.
     */
    function sendMessage(chatId) {
        // Získá zprávu uživatele z vstupního pole
        const userMessage = document.getElementById(`userMessage${chatId}`).value;

        // Zkontroluje, zda zpráva není prázdná
        if (userMessage.trim() !== '') {
            // Získá kontejner zpráv chatu
            const chatMessages = document.getElementById(`chatMessages${chatId}`);

            // Vytvoří nový div pro zprávu
            const messageDiv = document.createElement('div');

            // Přidá do divu třídy 'message' a 'sender'
            messageDiv.classList.add('message', 'sender');

            // Nastaví text divu zprávy na zprávu uživatele
            messageDiv.textContent = userMessage;

            // Přidá div zprávy do kontejneru zpráv chatu
            chatMessages.appendChild(messageDiv);

            // Vyčistí vstupní pole
            document.getElementById(`userMessage${chatId}`).value = '';

            // Posune se na dno chatu
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Odešle zprávu do druhého chatu
            sendMessageToOtherChat(chatId, userMessage);
        }
    }

    /**
     * Odešle zprávu od uživatele do druhého chatu.
     *
     * @param {string} currentChatId - ID aktuálního chatu.
     * @param {string} message - Zpráva k odeslání.
     */
    function sendMessageToOtherChat(currentChatId, message) {
        // Určí ID druhého chatu
        const otherChatId = currentChatId === '1' ? '2' : '1';

        // Získá kontejner zpráv druhého chatu
        const otherChatMessages = document.getElementById(`chatMessages${otherChatId}`);

        // Vytvoří nový div pro zprávu
        const messageDiv = document.createElement('div');

        // Přidá do divu třídy 'message' a 'other'
        messageDiv.classList.add('message', 'other');

        // Nastaví text divu zprávy na zprávu
        messageDiv.textContent = message;

        // Přidá div zprávy do kontejneru zpráv druhého chatu
        otherChatMessages.appendChild(messageDiv);

        // Posune se na dno druhého chatu
        otherChatMessages.scrollTop = otherChatMessages.scrollHeight;
    }
</script>
</body>
</html>
