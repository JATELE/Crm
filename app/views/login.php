<?php
session_start();
if (isset($_SESSION["usuario_sesion"])) {
    header("Location: views/dashboard.php");
} else {
    
}
include_once __DIR__ . '/../models/conexion.php';

$mensaje_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretkey = "6LeHhDQrAAAAAB2TgBaDJP4oC4gb2Vj_VPLx6a5s";

    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");
    $atributos = json_decode($respuesta, true);

    if (!$atributos['success']) {
        $mensaje_error = "⚠️ Por favor verifica el reCAPTCHA.";
    } else {
        $usuario = $_POST['user'];
        $password = $_POST['pass'];

        // Conectamos con el objeto de tu clase Conexion
        $conexion = new Conexion();
        $conexion->conectar();
        $conn = new mysqli(
            $conexion->getServidor(),
            $conexion->getUser(),
            $conexion->getClave(),
            $conexion->getDatabase()
        );

        // Preparar y ejecutar consulta segura
        $sql = "SELECT * FROM tb_usuario WHERE usuario = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $datos = $result->fetch_assoc();
            $_SESSION["usuario_sesion"] = [
                "nombre" => $datos["nombre"],
                "apellido" => $datos["apellido"],
                "id_rol" => $datos["id_rol"]
            ];
            header("Location: views/dashboard.php");
            exit;
        } else {
            $mensaje_error = "❌ Usuario o contraseña incorrectos.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CarWash SuperCar</title>
    <link rel="stylesheet" href="css/styleLogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
       <script src="html/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoDY6rgyjYUvOJfW_RIVmUbQMdZ8nFl4feHw&s) no-repeat;
  background-size: cover;
  background-position: center;
}

.wrapper {
  width: 420px;
  background: transparent;
  border: 2px solid rgba(255, 255, 255, 0.2); /* Corregido valor RGBA */
  backdrop-filter: blur(20px);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
  color: #fff;
  border-radius: 10px;
  padding: 30px 40px; 
}

.wrapper h1 {
  font-size: 36px;
  text-align: center;
}

.wrapper .input-box {
  position: relative;
  width: 100%;
  height: 50px;
  margin: 30px 0; 
}

.input-box input {
  width: 100%;
  height: 100%;
  background: transparent;
  border: none;
  outline: none;
  border: 2px solid rgba(255, 255, 255, 0.2); 
  font-size: 16px;
  color: #fff;
  padding: 20px 45px 20px 20px;
}

.input-box input::placeholder {
  color: #fff;
}

.input-box i {
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
}

.wrapper .remember-forgot {
  display: flex;
  justify-content: space-between;
  font-size: 14.5px;
  margin: -15px 0 15px;
}

.remember-forgot label input {
  accent-color: #fff;
  margin-right: 3px;
}

.remember-forgot a {
  color: #fff;
  text-decoration: none;
}

.remember-forgot a:hover {
  text-decoration: underline;
}

.wrapper .btn {
  width: 100%;
  height: 45px;
  background: #fff;
  border: none;
  outline: none;
  border-radius: 40px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  font-size: 16px;
  color: #333;
  font-weight: 600;
}

.wrapper .register-link {
  font-size: 14.5px;
  text-align: center;
  margin: 20px 0 15px;
}

.register-link p a {
  color: #fff;
  text-decoration: none;
  font-weight: 600;
}

.register-link p a:hover {
  text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="wrapper">
        <?php if (!empty($mensaje_error)) : ?>
            <div style="color: yellow; background: rgba(0,0,0,0.6); padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                <?php echo $mensaje_error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="user" placeholder="Usuario" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pass" placeholder="Contraseña" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <a href="">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="g-recaptcha" data-sitekey="6LeHhDQrAAAAAEweMk51gPdm2jlUSR4zYKWsDZjq"></div>

            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
    </div>
</body>


</html>