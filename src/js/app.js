document.addEventListener('DOMContentLoaded', function() { // 'DOMContentLoaded' Escucha que todo el documento esté cargado
    eventListeners();
    darkMode();
}); 

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

function darkMode() {
    const botonDarkMode = document.querySelector('.dark-mode-button');

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}