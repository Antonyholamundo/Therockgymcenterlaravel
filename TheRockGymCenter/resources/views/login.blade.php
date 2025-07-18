<?php
session_start();

// Si ya hay sesión activa, redirigir al index
if (isset($_SESSION['usuario'])) {
    header('Location: index.html');
    exit();
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario_valido = "admin";
    $contrasena_valida = "1234";

    $usuario = $_POST['username'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.html');
        exit();
    } else {
        header('Location: ' . $_SERVER['PHP_SELF'] . "?error=1");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - The Rock Gym Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="css/stilos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: gray;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .main-container {
            display: flex;
            align-items: center; 
            justify-content: flex-start; 
            width: 100%; 
            max-width: 1200px;
        }

        .login-container {
            background-color: #505050;
            padding: 25px;
            border-radius: 2px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            width: 325px;
            text-align: center;
            margin-left: center; 
        }

        .user-icon {
            background-color: #e71d23;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user-icon svg {
            fill: white;
            width: 80px;
            height: 80px;
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            color: #777;
        }

        .form-control {
            border-left: none;
        }

        .login-button {
            background-color: #e71d23;
        }

        .login-button:hover {
            background-color: #c0161d;
        }

        a {
            color: white;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

   
        .logo-container {
            margin-right: 20px; 
        }

        
        @media (max-width: 767.98px) {
            .main-container {
                justify-content: center; 
            }
            .login-container {
                margin-left: 0; 
            }
        }
    </style>

</head>

<body>
    <div class="main-container ">
      
        <div class="login-container">
            <div class="user-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>

            <form action="/login" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                        required>
                </div>

                <div class="mb-3 form-check text-start">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-white" for="remember">Recuérdame</label>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Iniciar sesión
                </button>

                <a href="#">Olvidé mi contraseña</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
s
</html>