document.addEventListener("DOMContentLoaded", function(){

    eventListeners();

    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);

    /** Muestra campos condicionales del formulario **/
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodoContacto));
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

function mostrarMetodoContacto(evt){
    const contactoDiv = document.querySelector("#contacto");
    
    if(evt.target.value === 'telefono'){
        contactoDiv.innerHTML = `
            <label for="telefono">Nro Telefono</label>
            <input type="tel" placeholder="Tu telefono" id="telefono"
            name="contacto[telefono]" required>

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input name="contacto[fecha]" type="date">

            <label for="hora">Hora</label>
            <input name="contacto[hora]" type="time" min="09:00" max="20:00">
        `;
    }else{
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu E-mail" id="email"
            name="contacto[email]" required>
        `;
    }
    
}