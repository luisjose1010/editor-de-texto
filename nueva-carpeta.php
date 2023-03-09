<?php

$fileName = '';
$directory = '';

if (isset($_GET['archivo']) && isset($_GET['directorio'])) {
    $fileName =  $_GET['archivo'];
    $directory = $_GET['directorio'];

    if (!(file_exists($directory . $fileName) && is_dir($directory . $fileName))) {
        try {
            mkdir($directory . $fileName);
        } catch (Exception $e) {
            echo "<script>window.location.href = './error.php?mensaje={$e->getMessage()}';</script>";
            die();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creando carpeta...</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        window.location.href = "./explorador.php?archivo=<?= $fileName ?>&directorio=<?= $directory ?>";
    </script>
</body>

</html>