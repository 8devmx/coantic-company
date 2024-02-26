<?php
$valTablaSeleccion = 'servicios';
$valTerminoSeleccion = 'ser';
require_once '../../includes/_funciones.php';
include '../../includes/_header.php';
page_protect();
$title = "Servicios";
$description = "";

$titulo1 = "Servicios";
$titulo2 = "Crear Nuevo Servicio";
$boton_agregar = "Nuevo Servicio";

?>
<input type="hidden" id="eliminar" value="0" />
<input type="hidden" id="idEdit" value="0" />
<input type="hidden" name="valTitle" id="valTitle" value="<?= $title ?>">
<input type="hidden" name="valActivo" id="valActivo" value="">

<!--**************************
    SUBIR GALERIA
**************************-->
<input type="hidden" id="ruta_imagen" value="../../../uploads/servicios/" class="norequired" />
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
        <input class="search searchProductos" type="search" data-column="all" placeholder="Buscar:" data-lastsearchtime="1510871449400" autocomplete="off">
      </div>
      <div class="col-sm-2">
        <a href="javascript:;" class="btn-gral fright agregar-datos"><?= $boton_agregar; ?></a>
      </div>

      <div class="clearfix h60"></div>

      <div class="col-sm-12 col-tabla-registros">
        <div class="scrolling-table">
          <table class="datos" id="tablaProductos">
            <thead>
              <tr>
                <th style="width: 5%; background-image: none;"></th>
                <th style="width: 55%;">Nombre:</th>
                <th style="width: 30%;">U. actualización:</th>
                <th style="width: 10%;">Estatus:</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <div class="tcenter">
          <div id="pagerProductos" class="pager">
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
          <?php $valNoDuplicar = 1; ?>
          <?php include '../../includes/_opcionesTabla.php'; ?>
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
          <input type="text" name="titulo" id="titulo" data-tcampo="Título" autocomplete="off">

          <label>Subtítulo: *</label>
          <input type="text" name="subtitulo" id="subtitulo" data-tcampo="Subtítulo" autocomplete="off">

          <label>Descripción:</label>
          <textarea name="descripcion" id="descripcion" class="norequired" data-tcampo="Descripción"></textarea>

        </div><!-- END col-sm-4 -->
        <div class="col-sm-offset-2 col-sm-8">
          <div class="clearfix h20"></div>
          <label>Beneficios:</label>
          <textarea name="beneficios" id="beneficios" class="txt_bullets norequired" data-tcampo="Beneficios" data-clase="bullets"></textarea>
          <div class="clearfix h30"></div>

          <label>Acerca de:</label>
          <textarea name="acerca" id="acerca" class="txt_bullets norequired" data-tcampo="Acerca de" data-clase="bullets"></textarea>
          <div class="clearfix h30"></div>

          <label>Características:</label>
          <textarea name="caracteristicas" id="caracteristicas" class="txt_bullets norequired" data-tcampo="Características" data-clase="bullets"></textarea>
          <div class="clearfix h30"></div>

          <label>Extras:</label>
          <textarea name="extras" id="extras" class="txt_bullets norequired" data-tcampo="Extras" data-clase="bullets"></textarea>
          <div class="clearfix h30"></div>

        </div><!-- END col-sm-4 -->
        <div class="col-sm-offset-2 col-sm-8">
          <div class="clearfix h20"></div>
          <label>Portada: (2092 × 860px)</label>
          <p>* No olvides optimizar las fotos antes de subirlas en la siguiente página: <a href="https://tinyjpg.com/"><b>https://tinyjpg.com/</b></a>.</p>
          <div class="cargaImagen">
            <form method="post" action="cmd_dropfile.php" id="formulario" enctype="multipart/form-data" class="formulario">
              <div class="cargar" id="dropu">
                <a>
                  <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                </a>
                <div class="label" id="lblDefault">ARRASTRAR O DA CLIC AQUÍ</div>
                <span style="display: none; color: red;" id="errorCarga"></span>
                <input type="file" id="foto" name="foto" class="norequired" />
              </div>
              <div class="imagenesResp" id="respuestafoto1"></div>
            </form>
            <p>Sólo se permiten imágenes PNG y JPG</p>
            <input type="hidden" id="foto1" name="foto_prod" accept="image/*" data-tcampo="Foto" value="" class="norequired" />
          </div><!--END cargaImagen-->

          <label>Imagen Beneficios (853 × 556px)</label>
          <div class="cargaImagen">
            <form method="post" action="cmd_dropfile_pdf.php" id="formulario_pdf" enctype="multipart/form-data" class="formulario">
              <div class="cargar" id="dropu_pdf">
                <a>
                  <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                </a>
                <div class="label" id="lblDefaultPDF">ARRASTRAR O DA CLIC AQUÍ</div>
                <span style="display: none; color: red;" id="errorCargaPDF"></span>
                <input type="file" id="archivopdf" name="archivopdf" accept="image/*" class="norequired" />
              </div>
              <div class="imagenesResp" id="respuestapdf"></div>
            </form>
            <input type="hidden" id="nombrepdf" name="pdf_prod" data-tcampo="Archivo pdf" value="" class="norequired" />
          </div><!--END cargaImagen-->

          <div class="row">
            <div class="col-sm-12">
              <div class="h30"></div>
              <label>Galería: (284x284 px)</label>
              <p>* No olvides optimizar las fotos antes de subirlas en la siguiente página: <a href="https://tinyjpg.com/"><b>https://tinyjpg.com/</b></a>.</p>
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
        <div class="col-sm-offset-2 col-sm-8">
          <div class="row">
            <div class="col-sm-6">
              <label for="downloads">Descargas</label>
              <form action="uploadDownloads.php" id="formDownload" enctype="multipart/form-data">
                <input type="file" name="downloads" id="downloads" style="opacity: 1;  font-size: 12px;padding: 10px; position: initial;" class="norequired">
              </form>
            </div>
            <div class="col-sm-4">
              <label for="downloads_title">Título</label>
              <input type="text" name="downloads_title" id="downloads_title" class="norequired">
            </div>
            <div class="col-sm-2">
              <button class="btn" style="margin-top: 19px; background: darkgoldenrod;color: #fff;font-weight: bold;" id="btnDownloads">Agregar</button>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <h3 class="downloadsHeader">Archivos agregados</h3>
              <ul id="downloadsLists">
              </ul>
            </div>
          </div>
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

  #mceu_26 {
    display: none;
  }

  .btnDelete {
    color: white;
    font-weight: bold;
    cursor: pointer;
    background: darkred;
    padding: 4px;
  }

  .downloadsHeader {
    font: 600 14px 'Open Sans', sans-serif;
    font-weight: bold;
    color: #364651;
    border-bottom: 1px dashed #364651;
    margin-bottom: 10px;
    padding-bottom: 5px;
  }

  #downloadsLists li {
    margin-bottom: 5px;
    padding: 5px 10px;
    display: block;
  }

  #downloadsLists li:nth-child(even) {
    background: #eee;
  }
</style>
<!-- TINYMCE -->
<script type="text/javascript" src="<?= base_url ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
  tinyMCE.init({
    selector: "#descripcion, #beneficios, #acerca, #caracteristicas, #extras",
    mode: "textareas",
    plugins: "paste",
    paste_auto_cleanup_on_paste: true
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
<script type="text/javascript" src="ajax_dropfile_pdf.js"></script>

</body>

</html>