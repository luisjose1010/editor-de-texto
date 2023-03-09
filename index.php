<?php

$fileName = "Nuevo documento de texto.txt";
$directory = './archivos/';
$content = '';

if (isset($_GET['archivo']) && isset($_GET['directorio'])) {
    $fileName = $_GET['archivo'];
    $directory = $_GET['directorio'];

    if ($file = fopen($directory . $fileName, 'r')) {
        if (filesize($directory . $fileName) > 0) {
            $content = fread($file, filesize($directory . $fileName));
        }
        fclose($file);
    } else {
        echo "<script>window.location.href = './error?mensaje=Archivo no encontrado.';</script>";
        die();
    }
} else if (isset($_GET['nuevo'])) {
    /*$i = 0;
    while(!$file = fopen($fileName . ($i > 0 ? "($i)" : '') . '.txt', 'x')){
        $i++;
    }*/
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= "$fileName" ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><?= "$fileName" ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="./?nuevo">Nuevo</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./explorador?abrir">Abrir...</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="javascript:formActions.save('<?= $fileName ?>', '<?= $directory ?>')">Guardar</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="javascript:formActions.saveAs('<?= $fileName ?>', '<?= $directory ?>')">Guardar como...</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container-fluid">
        <form id="text-form" action="" method="post">
            <textarea id="text" name="text"><?= $content ?></textarea>
            <br>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>

</html>