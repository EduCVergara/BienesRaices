document.addEventListener('DOMContentLoaded', function() { // 'DOMContentLoaded' Escucha que todo el documento esté cargado
    eventListeners();
    darkMode();
}); 

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        document.body.classList.toggle('dark-mode');
    })

    const botonDarkMode = document.querySelector('.dark-mode-button');

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive) //Escuchamos por un click

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    // if(navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // } else {
    //     navegacion.classList.add('mostrar');
    // } --- Este código indica que si la clase navegacion, dentro de su lista de clases contiene la clase 'mostrar', entonces la eliminará, y si no la tiene, la agregará. --
    // el código a continuación, hace exactamente lo mismo, Toggle = alternar

    navegacion.classList.toggle('mostrar');
}

// Eliminación de msje de confirmación

document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    if(window.innerWidth <= 768){
        temporaryClass(document.querySelector('.navegacion'), 'visibilidadTemporal', 500);
    }
 
    //Eliminar texto de confirmación de CRUD en admin/index.php
    borraMensaje();
});
 
function borraMensaje() {
    const mensajeConfirm = document.querySelector('.alerta');
    if (mensajeConfirm !== null) {
        setTimeout(function() {
            mensajeConfirm.classList.add('fade-out'); // Agrega la clase para el fade
            setTimeout(() => {
                mensajeConfirm.remove(); // Lo elimina después de la animación
            }, 500); // Debe coincidir con la duración en CSS
        }, 3000); // Espera antes de iniciar el fade
    }
}

// Modal confirmación de eliminación
function abrirModal(event, id) {
    event.preventDefault(); // Evita que el formulario se envíe

    if (!id || isNaN(id) || id <= 0) {
        alert("ID no válido. No se puede eliminar la propiedad.");
        return false;
    }

    // Guardamos el ID en el input del modal
    document.getElementById("idEliminar").value = id;
    
    // Mostramos el modal
    document.getElementById("modalConfirmacion").style.display = "flex";
}

function cerrarModal() {
    document.getElementById("modalConfirmacion").style.display = "none";
}