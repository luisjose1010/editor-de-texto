let formActions = {
    save: function (file, directory) {
        let form = document.querySelector('#text-form');
        form.action = "./guardar.php?archivo=" + file + "&directorio=" + directory;
        form.submit();
    },
    saveAs: function (file, directory) {
        let form = document.querySelector('#text-form');
        form.action = "./explorador.php?guardar-como&archivo=" + file + "&directorio=" + directory;
        form.submit();
    }
}

let actions = {
    action: function (action, file, directory) {
        switch (action) {
            case "Abrir":
                window.location.href = "./?archivo=" + file + "&directorio=" + directory;
                break;

            case "Reemplazar":
                let form = document.querySelector('#text-form');
                form.action = "./guardar.php?archivo=" + file + "&directorio=" + directory;
                form.submit();
                break;
        }
    },
    delete: function (file, directory) {
        window.location.href = "./eliminar.php?archivo=" + file + "&directorio=" + directory;
    },
    accept: function (action, file, directory) {
        switch (action) {
            case "Abrir":
                window.location.href = "./?archivo=" + file + "&directorio=" + directory;
                break;

            case "Reemplazar":
                let form = document.querySelector('#text-form');

                form.action = "./guardar.php?archivo=" + file + "&directorio=" + directory;
                form.submit();
                break;
        }
    },
    cancel: function () {
        window.location.href = "./";
    },
    createFolder: function (file, directory) {
        window.location.href = "./nueva-carpeta.php?archivo=" + file + "&directorio=" + directory;
    }
}