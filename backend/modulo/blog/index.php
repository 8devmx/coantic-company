<?php
$valTablaSeleccion = 'blog';
$valTerminoSeleccion = 'blog';
require_once '../../includes/_funciones.php';
include '../../includes/_header.php';
page_protect();
$title = "Blog";
$description = "";

$titulo1 = "Blog";
$titulo2 = "Crear Nuevo Blog";
$boton_agregar = "Nuevo Blog";

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
                                <!-- <th style="width: 15%;">Ui:</th> -->
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
                    <input type="text" name="nom_blog" id="nom_blog" class="required" data-tcampo="Título" autocomplete="off">

                    <label>Subtitulo:</label>
                    <input type="text" name="texto1_blog" id="texto1_blog" class="required" data-tcampo="Subtitulo" autocomplete="off">

                    <label style="display: none;">Texto 2:</label>
                    <input style="display: none;" type="text" name="texto2_blog" id="texto2_blog" class="norequired" data-tcampo="Texto 2" autocomplete="off">

                    <label style="display: none;">Texto 3:</label>
                    <input style="display: none;" type="text" name="texto3_blog" id="texto3_blog" class="norequired" data-tcampo="Texto 3" autocomplete="off">

                    <label>Contenido:</label>
                    <textarea name="desc_blog" id="desc_blog" class="norequired" data-tcampo="Contenido"></textarea>

                </div><!-- END col-sm-offset-2 col-sm-8 -->
                <div class="col-sm-offset-2 col-sm-8" style="display: none;">
                    <div class="clearfix h30"></div>
                    <label>Bullets 1:</label>
                    <textarea name="bullets1_blog" id="bullets1_blog" class="txt_bullets norequired" data-tcampo="Bullets 1" data-clase="bullets"></textarea>
                    <div class="clearfix h30"></div>

                    <label>Bullets 2:</label>
                    <textarea name="bullets2_blog" id="bullets2_blog" class="txt_bullets norequired" data-tcampo="Bullets 2" data-clase="bullets"></textarea>
                    <div class="clearfix h30"></div>

                    <label>Bullets 3:</label>
                    <textarea name="bullets3_blog" id="bullets3_blog" class="txt_bullets norequired" data-tcampo="Bullets 3" data-clase="bullets"></textarea>
                    <div class="clearfix h30"></div>

                </div><!-- END col-sm-offset-2 col-sm-8 -->
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="clearfix h30"></div>
                    <label>Foto: (1506x1000 px)</label>
                    <p>* No olvides optimizar las fotos antes de subirlas en la siguiente página: <a href="https://tinyjpg.com/" target="_blank"><b>https://tinyjpg.com/</b></a>.</p>
                    <div class="cargaImagen">
                        <form method="post" action="cmd_dropfile.php" id="formulario" enctype="multipart/form-data" class="formulario">
                            <div class="cargar" id="dropu">
                                <a>
                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                </a>
                                <div class="label" id="lblDefault">ARRASTRAR O DA CLIC AQUÍ</div>
                                <span style="display: none; color: red;" id="errorCarga"></span>
                                <input type="file" id="foto" name="foto" accept="image/*" class="norequired" />
                            </div>
                            <div class="imagenesResp" id="respuestafoto1"></div>
                        </form>
                        <p>Sólo se permiten imágenes PNG y JPG</p>
                        <input type="hidden" id="foto1" name="foto_blog" data-tcampo="Foto" value="" class="required" />
                    </div><!--END cargaImagen-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="h30"></div>
                            <label>Galería: (1170x900 px)</label>
                            <p>* No olvides optimizar las fotos antes de subirlas en la siguiente página: <a href="https://tinyjpg.com/" target="_blank"><b>https://tinyjpg.com/</b></a>.</p>
                            <!--HTML MODULO DE IMAGENES-->
                            <form id="upload" method="post" action="cmd_dropfile_galeria.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="drop">
                                            Arrastrar aquí
                                            <br />
                                            <a>Buscar</a>
                                            <input type="file" name="archivo" accept="image/*" class="norequired" />
                                        </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <ul class="lista">

                                        </ul>
                                        <div class="row">
                                            <ul id="gale" class="gale galeria galerias">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p>Sólo imágenes con formato PNG, JPEG, JPG, GIF, SVG.</p>
                        </div>
                    </div><!-- END row -->
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
        selector: "#desc_blog, #bullets1_blog, #bullets2_blog, #bullets3_blog ",
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