<?php

$action = null;
$actionKey = null;
$directory = "./archivos/";
$files = [];
$content = '';

if (isset($_POST['text'])) {
    $content = $_POST['text'];
}

if (isset($_GET['directorio'])) {
    $directory = $_GET['directorio'];
}

if (isset($_GET['abrir'])) {
    $action = 'Abrir';
    $actionKey = 'abrir';
} else if (isset($_GET['guardar-como'])) {
    $action = 'Reemplazar';
    $actionKey = 'guardar-como';
} else {
    $action = 'Opciones';
}

$directories = scandir($directory);
$directories = array_values(array_diff($directories, array('.')));

for ($i = 0; $i < count($directories); $i++) {
    $fileName = $directories[$i];

    try {
        $fileInfo = stat($directory . $fileName);
    } catch (Exception $e) {
        echo "<script>window.location.href = './error?mensaje={$e->getMessage()}';</script>";
        die();
    }



    $files[$i] = [
        'name' => $fileName,
        'type' => filetype($directory . $fileName),
        'size' => $fileInfo[7] . 'bytes',
        'atime' => gmdate("Y-m-d | H:i:s", $fileInfo[8]),
        'mtime' => gmdate("Y-m-d | H:i:s", $fileInfo[9]),
    ];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorador de archivos</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Explorador de archivos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <form id="search-form" class="form-inline my-2 my-lg-0">
                <input id="search" class="form-control mr-sm-2 m-1" type="text" placeholder="Nombre">
                <button class="btn btn-outline-success my-2 my-sm-0 m-1" onclick="actions.accept('<?= $action ?>', document.querySelector('#search').value, '<?= $directory ?>')" type="button">
                    <?= $actionKey === 'guardar-como' ? 'Guardar' : 'Aceptar' ?>
                </button>
                <button class="btn btn-outline-danger my-2 my-sm-0 m-1" onclick="actions.cancel()" type="button">Cancelar</button>
                <button class="btn btn-outline-warning my-2 my-sm-0 m-1" onclick="actions.createFolder(document.querySelector('#search').value, '<?= $directory ?>')" type="button">Crear Carpeta</button>
            </form>

        </nav>
    </header>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Tamaño</th>
                <th scope="col">Fecha de último acceso</th>
                <th scope="col">Fecha de modificación</th>
                <th scope="col"><?= $action ?></th>
                <th scope="col">Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($files); $i++) : ?>
                <tr>
                    <td><?= $files[$i]['name'] ?></td>
                    <td><?= $files[$i]['type'] ?></td>
                    <td><?= $files[$i]['size'] ?></td>
                    <td><?= $files[$i]['atime'] ?></td>
                    <td><?= $files[$i]['mtime'] ?></td>
                    <td>
                        <?php if ($files[$i]['type'] !== 'dir') : ?>
                            <button onclick="actions.action('<?= $action ?>', '<?= $files[$i]['name'] ?>', '<?= $directory ?>')">
                                ✅
                            </button>
                        <?php else : ?>
                            <button onclick="window.location.href = '<?= './explorador?' . $actionKey . '&directorio=' . $directory . $files[$i]['name'] . '/' ?>'">
                                ✅
                            </button>
                        <?php endif ?>
                    </td>
                    <td>
                        <button onclick="actions.delete('<?= $files[$i]['name'] ?>', '<?= $directory ?>')">
                            ❌
                        </button>
                    </td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>

    <form id="text-form" action="" method="post" class="d-none">
        <textarea id="text" name="text"><?= $content ?></textarea>
        <br>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>
</body>

</html>