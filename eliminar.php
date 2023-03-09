<?php

$fileName = '';
$directory = '';

if (isset($_GET['archivo']) && isset($_GET['directorio'])) {
    $fileName =  $_GET['archivo'];
    $directory = $_GET['directorio'];

    try {
        if (is_dir($directory . $fileName)) {
            rmdir($directory . $fileName);
        } else {
            unlink($directory . $fileName);
        }
    } catch (Exception $e) {
        echo "<script>window.location.href = './error.php?mensaje={$e->getMessage()}';</script>";
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
    <title>Eliminando...</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        window.location.href = "./explorador.php?archivo=&directorio=<?= $directory ?>";
    </script>
</body>

</html>