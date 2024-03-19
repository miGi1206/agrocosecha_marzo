<script>
    function leerMas(id) {
        var detalle = document.querySelector('[codigo_producto="detalle' + id + '"]');
        var botonLeerMas = document.querySelector('button[onclick="leerMas(' + id + ')"]');
        var botonLeerMenos = document.querySelector('button[onclick="leerMenos(' + id + ')"]');

        // Muestra el detalle y cambia el texto del botón a "Leer menos"
        detalle.style.display = 'inline';
        botonLeerMas.style.display = 'none';
        botonLeerMenos.style.display = 'inline';
    }

    function leerMenos(id) {
        var detalle = document.querySelector('[codigo_producto="detalle' + id + '"]');
        var botonLeerMas = document.querySelector('button[onclick="leerMas(' + id + ')"]');
        var botonLeerMenos = document.querySelector('button[onclick="leerMenos(' + id + ')"]');

        // Oculta el detalle y cambia el texto del botón a "Leer más"
        detalle.style.display = 'none';
        botonLeerMas.style.display = 'inline';
        botonLeerMenos.style.display = 'none';
    }
</script>
