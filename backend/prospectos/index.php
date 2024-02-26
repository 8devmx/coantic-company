<?php
$valTablaSeleccion = 'tbl_prospectos';
$valTerminoSeleccion = 'pros';
require_once '../includes/_funciones.php';
include '../includes/_header.php';
page_protect();
$title = "Prospectos";
$description = "";

$titulo1 = "Prospectos";
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

            <div class="col-sm-3">
                <h1 class="titulo"><?= $titulo1; ?></h1>
                <div class="clearfix w10 visible-xs"></div>
            </div>
            <div class="col-sm-2">
                <div class="selectt mb0">
                    <?PHP 
                        $sql = "SELECT *, (SELECT COUNT(id_pros) FROM tbl_prospectos WHERE idprod_pros = id_prod AND activo_pros = 1 ) AS total FROM tbl_productos 
                        WHERE (activo_prod = 1 OR activo_prod = 0) ORDER BY nom_prod ASC;";
                    ?>
                    <select name="slcCampanas" id="slcCampanas">
                        <option value="">Todos</option>
                        <?PHP 
                            $res = $db->query($sql)->fetchAll();
                            
                            foreach($res as $rows){

                                if($rows["total"] > 0){
                        ?>
                        <option value="<?= $rows['id_prod']?>"><?= $rows["nom_prod"]?> [<?= $rows["total"]?>]</option>
                        <?PHP 
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 tcenter">
                <input type="text" name="slcFechai" id="slcFechai" class="slcFechas mb0 primero" placeholder="Desde" autocomplete="off"> al <input type="text" name="slcFechaf" id="slcFechaf" class="slcFechas mb0 segundo" placeholder="Hasta" autocomplete="off">
            </div>
            <div class="col-sm-2 buscador-sorter">
                <input class="search searchProspectos mb0" type="search" data-column="all" placeholder="Buscar:" data-lastsearchtime="1510871449400" autocomplete="off">
            </div>
            <div class="col-sm-2">
                <a href="javascript:;" class="btn-gral fright exportar-datos">Exportar CSV</a>
            </div>

            <div class="clearfix h60"></div>
            
            <div class="col-sm-12 col-tabla-registros">
                <div class="scrolling-table">
                    <table class="datos" id="tablaPros">
                        <thead>
                            <tr>
                                <th style="width: 5%; background-image: none;"></th>
                                <th style="width: 25%;">Nombre:</th>
                                <th style="width: 10%;">Teléfono:</th>
                                <th style="width: 10%;">Correo:</th>
                                <th style="width: 30%;">Interés en:</th>
                                <th style="width: 20%;">Fecha:</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="tcenter">
                    <div id="pagerPros" class="pager">
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
                        $valNoDuplicar = 1; /*$valNoEliminar = 1;*/ $txtOpcionEditar = "VER";
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
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Fecha:</label>
                            <div class="inputDisabled he40 fechareg_pros"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Interés en:</label>
                            <div class="inputDisabled he40 nom_prod"></div>
                        </div>
                    </div>
                    <label>Nombre:</label>
                    <div class="inputDisabled he40 nom_pros"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Correo:</label>
                            <div class="inputDisabled he40 correo_pros"></div>
                        </div>
                        <div class="col-sm-6">
                            <label>Teléfono:</label>
                            <div class="inputDisabled he40 tel_pros"></div>
                        </div>
                    </div>
                    
                    <label>Empresa/Proyecto:</label>
                    <div class="inputDisabled he40 empresa_pros"></div>
                    <label style="display: none;">Proyecto:</label>
                    <div class="inputDisabled he40 proyecto_pros" style="display: none;"></div>
                    <label>Mensaje:</label>
                    <div class="inputDisabled he80 mensaje_pros"></div>
                </div><!-- END col-sm-8 -->

                <div class="clearfix h50"></div>

                <div class="col-sm-offset-8 col-sm-2">
                    <a href="javascript:;" class="btn-gral cerrar">Cerrar</a>
                </div>
            </div>

            <div class="clearfix h30"></div>
        </div>
    </div>
</div>

<div id="alerta" title="Eliminar">
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