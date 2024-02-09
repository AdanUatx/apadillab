const formularios_ajax = document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", function (e){
        e.preventDefault();

        let data = new FormData(this);
        let method = this.getAttribute("method");
        let action = this.getAttribute("action");

        let encabezados = new Headers();

        let config={
            method: method,
            header: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        fetch(action, config)
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                alert(respuesta.msg);
                if (respuesta.redirect) {
                    window.location.href = respuesta.redirect;
                }
            });
    });

})

