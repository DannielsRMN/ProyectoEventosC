<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | Administrador</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-content {
            padding: 40px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            color: #37353E;
            margin-top: 0;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.5rem;
        }

        .form-group {
            width: 100%;
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #b0b8b7;
            background-color: #fcfcfc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s;
        }

        input:focus {
            border-color: #37353E;
            box-shadow: 0 0 5px rgba(55, 53, 62, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #37353E;
            color: #D3DAD9;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #25232a;
        }

        .error-msg {
            color: #d93025;
            font-size: 12px;
            margin-bottom: 15px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .card-container {
                width: 85vw !important;
                height: auto !important;
                min-height: 40vh;
            }
        }
    </style>
</head>

<body style="background-color: #37353E; width: 100vw; height: 100vh; display: flex; justify-content: center; align-items: center; overflow: hidden; margin: 0;">
    
    <div class="card-container" style="background-color: #D3DAD9; width: 30vw; height: 50vh; border-radius: 14px; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        
        <div class="login-content">
            <h2>Administrador</h2>

            <?php if(isset($error)): ?>
                <div class="error-msg">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/ProyectoEventosC/controllers/auth.php" method="POST" style="width: 100%;">
                
                <div class="form-group">
                    <input type="email" name="email" placeholder="Correo Electrónico" required autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>

                <input type="submit" value="Login">
            </form>
        </div>

    </div>
</body>

</html>