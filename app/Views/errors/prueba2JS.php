<div class="col-lg-12 col-xlg-12 col md-12">
    <div class="card" style="padding: 25 px">
        <h3>
            Buscar / usuarios
            <button class="btn btn-succes" id="regresar">
                <i class="fa fa-plus"></i>Weekly
        </h3>

        <p>Buscar</p>

        <form class="form-material">

        </form>
        <div id="load"></div>
    </div>
</div>
<script src="../public/biuld/js/ajaxprueba.js"></script>
<script>
    'use strict'
    $(document).ready(function(){
        $("#frmWeekly").click(function(){
            cargarFormulario();
        });
    });

    function cargarFormulario(){
        cargando('Cargando contenido...')
        $("#root").load("Views/html/prueba2JS", function(){
            swal.close();
        });
    }

    function caragarPrueba(){
        cargando('Cargando contenido...')
        $("#root").load("Views/html/pruebaJS", function(){
            swal.close();
        });
    }
</script>