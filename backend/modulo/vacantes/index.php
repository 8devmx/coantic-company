<?php
$valTablaSeleccion = 'vacantes';
$valTerminoSeleccion = 'vac';
require_once '../../includes/_funciones.php';
include '../../includes/_header.php';
page_protect();
$title = "Vacante";
$description = "";

$titulo1 = "Vacantes";
$titulo2 = "Crear Nuevo Vacante";
$boton_agregar = "Nuevo Vacante";

?>
<input type="hidden" id="eliminar" value="0" />
<input type="hidden" id="idEdit" value="0" />
<input type="hidden" name="valTitle" id="valTitle" value="<?= $title ?>">
<input type="hidden" name="valActivo" id="valActivo" value="">

<!--**************************
    SUBIR GALERIA
**************************-->
<input type="hidden" id="ruta_imagen" value="../../../uploads/blog/" class="norequired" />
<input type="hidden" id="parent" class="norequired" />
<input type="hidden" id="imagen-eliminar" class="norequired" />

<div class="contenido-gral">
    <div class="container">
        <div class="row vista-principal pabs">

            <div class="col-sm-6">
                <h1 class="titulo"><?= $titulo1; ?></h1>
                <div class="clearfix w10 visible-xs"></div>
            </div>
            <div class="col-sm-4 buscador-sorter tright">
                <input class="search searchBlog" type="search" data-column="all" placeholder="Buscar:" data-lastsearchtime="1510871449400" autocomplete="off">
            </div>
            <div class="col-sm-2">
                <a href="javascript:;" class="btn-gral fright agregar-datos"><?= $boton_agregar; ?></a>
            </div>

            <div class="clearfix h60"></div>

            <div class="col-sm-12 col-tabla-registros">
                <div class="scrolling-table">
                    <table class="datos" id="tablaBlog">
                        <thead>
                            <tr>
                                <th style="width: 5%; background-image: none;"></th>
                                <th style="width: 65%;">Nombre:</th>
                                <th style="width: 30%;">U. actualización:</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="tcenter">
                    <div id="pagerBlog" class="pager">
                        <form>
                            <i class="fa fa-angle-double-left first" aria-hidden="true"></i>
                            <i class="fa fa-angle-left prev" aria-hidden="true"></i>
                            <input type="text" class="pagedisplay" readonly />
                            <i class="fa fa-angle-right next" aria-hidden="true"></i>
                            <i class="fa fa-angle-double-right last" aria-hidden="true"></i>
                            <select class="pagesize">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-2 col-tabla-opciones tcenter">
                <div class="fixed-opciones">
                    <?php
                    $valNoDuplicar = 1;
                    include '../../includes/_opcionesTabla.php';
                    ?>
                </div>
            </div>

            <div class="clearfix h30"></div>

            <div class="col-sm-offset-10 col-sm-2">
                <a href="javascript:;" class="btn-gral fright agregar-datos"><?= $boton_agregar; ?></a>
            </div>
        </div>


        <div class="row vista-edicion">
            <div class="col-sm-offset-2 col-sm-6">
                <h1 class="titulo"><?= $titulo2; ?></h1>
                <input type="hidden" value="<?= $titulo2; ?>" id="titulo-default">
            </div>
            <div class="col-sm-2">
                <a href="javascript:;" class="btn-gral gris cerrar fright fright-xs">Cerrar</a>
            </div>

            <div class="clearfix h30"></div>

            <div class="recopilar-datos">
                <div class="col-sm-offset-2 col-sm-8">
                    <label>Título: *</label>
                    <input type="text" name="nom_vac" id="nom_vac" class="required" data-tcampo="Título" autocomplete="off">

                    <label>Horario:</label>
                    <input type="text" name="texto1_vac" id="texto1_vac" class="required" data-tcampo="Subtitulo" autocomplete="off">

                    <label>Contenido:</label>
                    <textarea name="desc_vac" id="desc_vac" class="norequired" data-tcampo="Contenido"></textarea>

                </div>
                <div class="clearfix h50"></div>

                <div class="col-sm-offset-8 col-sm-2">
                    <a href="javascript:;" class="btn-gral guardar-datos" data-accion="guardar">Guardar</a>
                </div>
            </div>

            <div class="clearfix h30"></div>
        </div>
    </div>
</div>

<div id="alerta" title="Eliminar">
    <p align="center">¿Deseas continuar con la eliminación de<br>
        <b><span id="txtEliminar"></span></b>
        ?
    </p>
</div>

<div id="alerta2" style="display: none;" title="Eliminar Imagen">
    <p>¿Desea eliminar la imagen?</p>
</div>

<?php

include '../../includes/_footer.php';
include '../../includes/_modal_duplicar.php';
?>
<style>
    .mce-menubar .mce-menubtn button {
        display: none;
    }

    #mceu_22 {
        display: none;
    }

    #mceu_24 {
        display: none;
    }

    /*#mceu_25 {display: none;}*/
    #mceu_26 {
        display: none;
    }
</style>
<!-- TINYMCE -->
<script type="text/javascript" src="<?= base_url ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinyMCE.init({
        selector: "#desc_vac, #bullets1_vac, #bullets2_vac, #bullets3_vac ",
        mode: "textareas",
        plugins: "paste",
        paste_auto_cleanup_on_paste: true,
        //body_class: "elm1=cls_descripcion,elm2=cls_bullets1,elm3=cls_bullets2,elm4=cls_bullets3",
    });
</script>

<!--//SUBIR IMAGENES POR DROPDOWN JS-->
<script src="<?= base_url; ?>js/dropfile/jquery.knob.js"></script>
<script src="<?= base_url; ?>js/dropfile/jquery.ui.widget.js"></script>
<script src="<?= base_url; ?>js/dropfile/jquery.iframe-transport.js"></script>
<script src="<?= base_url; ?>js/dropfile/jquery.fileupload.js"></script>
<link href="<?= base_url ?>js/dropfile/style.css" rel="stylesheet" />
<script src="<?= base_url ?>js/dropfile/script.js"></script>

<script type="text/javascript" src="controlador.js"></script>
<script type="text/javascript" src="ajax_dropfile.js"></script>

</body>

</html>