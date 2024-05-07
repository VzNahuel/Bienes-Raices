document.addEventListener("DOMContentLoaded", function(){

    eventListeners();

    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");

    if (navegacion.classList.contains('mostrar')){
        navegacion.classList.remove("mostrar");
    }else{
        navegacion.classList.add("mostrar");
    }
}

function darkMode(){
    const prefiereDarkMode = window.matchMedia("(preferes-color-scheme: dark)");

    console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches){
        document.body.classList.add("dark-mode");
    }else{
        document.body.classList.remove("dark-mode");
    }

    prefiereDarkMode.addEventListener("change", function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add("dark-mode");
        }else{
            document.body.classList.remove("dark-mode");
        }
    })

    const botonDarkMode = document.querySelector(".boton-dark-mode");

    botonDarkMode.addEventListener("click", function(){
        if (document.body.classList.contains("dark-mode")){
            document.body.classList.remove("dark-mode");
        }else{
            document.body.classList.add("dark-mode");
        }
    })
}