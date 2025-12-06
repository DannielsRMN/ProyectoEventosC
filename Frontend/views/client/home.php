<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Frontend/assets/css/index.css">
    <title>EventosC | Inicio</title>
</head>
<body>

    <?php require_once 'Frontend/views/layouts/header.php'; ?>

    <div>
        <div class="first">
            <video src="Frontend/assets/img/background.mp4" autoplay muted loop></video>
        </div>

        <div class="content">
            <div class="desc">
                <h2>Bienvenidos a EventosC</h2>
                <br>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem vitae laborum sint, repellendus hic unde dicta ut. Voluptatum officia repudiandae hic totam, consequuntur corrupti! Perspiciatis mollitia iusto numquam tempore a?</p>

                <a href="index.php?view=reservas" style="text-decoration: none;">
                    <button>Reserva Aquí</button>
                </a>
            </div>
        </div>

        <div class="sep">
            <hr style="width: 100%; border: 1px solid #333;">
        </div>
    </div>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>

</body>
</html>