<?php
$valTablaSeleccion = 'tbl_configuracion';
$valTerminoSeleccion = 'config';
require_once '../includes/_funciones.php';
include '../includes/_header.php';
page_protect();
$title = "Configuración";
$description = "";

$titulo1 = "Configuración";
$titulo2 = "";
$boton_agregar = "";

?>
<input type="hidden" id="eliminar" value="0" />
<input type="hidden" id="idEdit" value="0" />
<input type="hidden" name="valTitle" id="valTitle" value="<?=$title?>">
<input type="hidden" name="valActivo" id="valActivo" value="">

<div class="contenido-gral">
    <div class="container">
        <div class="row vista-principal pabs">

            <div class="col-sm-10">
                <h1 class="titulo"><?= $titulo1; ?></h1>
                <div class="clearfix w10 visible-xs"></div>
            </div>
            <div class="col-sm-2">
                <a href="javascript:;" class="btn-gral fright agregar-datos" style="display: none;"><?= $boton_agregar; ?></a>
            </div>

            <div class="clearfix h60"></div>
            
            <div class="col-sm-12 col-tabla-registros">
                <div class="scrolling-table">
                    <table class="datos" id="tablaConfig">
                        <thead>
                            <tr>
                                <th style="width: 5%; background-image: none;"></th>
                                <th style="width: 40%;">Nombre:</th>
                                <th style="width: 25%;">Valor:</th>
                                <th style="width: 30%;">U. actualización:</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="tcenter">
                    <div id="pagerConfig" class="pager">
                        <form>
                            <i class="fa fa-angle-double-left first" aria-hidden="true"></i>
                            <i class="fa fa-angle-left prev" aria-hidden="true"></i>
                            <input type="text" class="pagedisplay" readonly/>
                            <i class="fa fa-angle-right next" aria-hidden="true"></i>
                            <i class="fa fa-angle-double-right last" aria-hidden="true"></i>
                            <select class="pagesize">
                                <option selected="selected"  value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option  value="40">40</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-2 col-tabla-opciones tcenter">
                <div class="fixed-opciones">
                    <?php 
                        $valNoDuplicar = 1; $valNoEliminar = 1;
                        include '../includes/_opcionesTabla.php';
                    ?>
                </div>
            </div>

            <div class="clearfix h30"></div>

            <div class="col-sm-offset-10 col-sm-2">
                <a href="javascript:;" class="btn-gral fright agregar-datos" style="display: none;"><?= $boton_agregar; ?></a>
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
                    <label>Nombre:</label>
                    <div class="inputDisabled he40 nom_config hovertoptip chovertooltip" data-title="Campo no editable"></div>
                    <label>Valor (es):</label>
                    <input type="text" name="valor_config" id="valor_config" class="norequired toptip cfocustooltip" data-title="No escribir comillas dobles('') o simples (')" data-tcampo="Valor" autocomplete="off">
                    <p class="pinstrucciones"><b>Nota:</b> Para cuentas de correo, porfavor separa las cuentas con una coma, por ejemplo: cuenta1@dominio.com<b class="bpcoma">,</b>cuenta2@dominio.com</p>
                </div><!-- END col-sm-8 -->

                <div class="clearfix h50"></div>

                <div class="col-sm-offset-8 col-sm-2">
                    <a href="javascript:;" class="btn-gral guardar-datos" data-accion="guardar">Guardar</a>
                </div>
            </div>

            <div class="clearfix h30"></div>
        </div>
    </div>
</div>

<div id="alerta" style="display: none;" title="Eliminar">
    <p align="center">¿Deseas continuar con la eliminación de<br>
        <b><span id="txtEliminar"></span></b>
    ?</p>
</div>

<?php
include '../includes/_footer.php';
?>

<script type="text/javascript" src="controlador.js"></script>

</body>
</html>