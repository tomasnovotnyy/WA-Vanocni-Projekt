<!DOCTYPE html>
<html lang="en">

<head>
    <title>ChatZone</title>
    <link rel="icon" type="image/x-icon" href="img/Favicon/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
    </style>
</head>

<body class="bg-dark">

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary py-3" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="img/Logo/logo2.png" alt="logo"><span
                        id="blackText">Chat</span><span id="redText">Zone</span></a>
            </div>
        </nav>
    </header>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Login/Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="login/logme.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success" onclick="saveCredentials()">Login</button>
                            </div>
                        </form>
                        <br>
                        <form action="login/registerme.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success" onclick="saveCredentials()">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center bg-dark text-white pb-4">
        <div class="container text-center text-md-left">
            <div class="row text-center text-md-left">
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-success">Contact</h5>
                    <p>
                        <i class="fas fa-home mr-3"></i> Jecna 517/30, 120 00 Prague 2, Czechia
                    </p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> +420 123 456 789
                    </p>
                </div>
            </div>

            <hr class="mb-4" style="color: white;">

            <div class="row align-items-center">
                <div>
                    <p>Copyright 2024 All rights reserved by:
                        <a href="" style="text-decoration: none;">
                            <strong class="text-success">Tomas Novotny</strong>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

    <script>
        function saveCredentials() {
            var username = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            localStorage.setItem("email", username);
            localStorage.setItem("password", password);
        }
    </script>
</body>

</html>