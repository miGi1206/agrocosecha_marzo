<script>
    function leerMas(id) {
        var resumen = document.getElementById('resumen' + id);
        var detalle = document.getElementById('detalle' + id);
        var botonLeerMas = document.querySelector('button[onclick="leerMas(' + id + ')"]');
        var botonLeerMenos = document.querySelector('button[onclick="leerMenos(' + id + ')"]');

        // Muestra el detalle y oculta el resumen y el botón "Leer más"
        resumen.style.display = 'inline';
        detalle.style.display = 'inline';
        botonLeerMas.style.display = 'none';
        botonLeerMenos.style.display = 'inline';
    }

    function leerMenos(id) {
        var resumen = document.getElementById('resumen' + id);
        var detalle = document.getElementById('detalle' + id);
        var botonLeerMas = document.querySelector('button[onclick="leerMas(' + id + ')"]');
        var botonLeerMenos = document.querySelector('button[onclick="leerMenos(' + id + ')"]');

        // Muestra el resumen y oculta el detalle y el botón "Leer menos"
        resumen.style.display = 'inline';
        detalle.style.display = 'none';
        botonLeerMas.style.display = 'inline';
        botonLeerMenos.style.display = 'none';
    }
</script>