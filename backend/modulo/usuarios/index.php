<?php
#Esta es una prueba con dos archivos
$valTablaSeleccion = 'tbl_usuarios';
$valTerminoSeleccion = 'usr';
require_once '../../includes/_funciones.php';
include '../../includes/_header.php';
page_protect();
$title = "Usuarios";
$description = "";

$titulo1 = "Usuarios";
$titulo2 = "Crear Nuevo Usuario";
$boton_agregar = "Nuevo Usuario";

?>
<input type="hidden" id="eliminar" />
<input type="hidden" name="valTitle" id="valTitle" value="<?=$title?>">
<input type="hidden" name="valActivo" id="valActivo" value="">

<div class="contenido-gral" id="app">
  <div class="container">
    <div class="row vista-principal pabs" v-if="componentView===1">
      <div class="col-sm-6">
        <h1 class="titulo"><?= $titulo1; ?></h1>
        <div class="clearfix w10 visible-xs"></div>
      </div>
      <div class="col-sm-4 buscador-sorter tright">
        <input class="search searchUsuarios" type="search" data-column="all" placeholder="Buscar:"
          data-lastsearchtime="1510871449400" autocomplete="off">
      </div>
      <div class="col-sm-2">
        <a href="javascript:;" class="btn-gral fright agregar-datos"><?= $boton_agregar; ?></a>
      </div>

      <div class="clearfix h60"></div>
      <div class="col-sm-12 col-tabla-registros">
        <div class="scrolling-table">
          <table class="datos" id="tablaUsuarios">
            <thead>
              <tr>
                <th style="width: 5%; background-image: none;"></th>
                <th>Nombre:</th>
                <th>Usuario:</th>
                <th>Tipo:</th>
                <th>Permisos:</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in items">
                <td style="width: 5%; background-image: none;"></td>
                <td>{{item.nombre}}</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="tcenter">
          <div id="pagerUsuarios" class="pager">
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


    <div class="row vista-edicion" style="display: none;" v-if="componentView===2">
      <div class="col-sm-offset-1 col-sm-8">
        <h1 class="titulo"><?= $titulo2; ?></h1>
        <input type="hidden" value="<?= $titulo2; ?>" id="titulo-default">
      </div>
      <div class="col-sm-2">
        <a href="javascript:;" class="btn-gral gris cerrar fright fright-xs">Cerrar</a>
      </div>

      <div class="clearfix h30"></div>

      <div class="recopilar-datos">
        <div class="col-sm-offset-1 col-sm-5">
          <label>Nombre:</label>
          <input type="text" name="nombre" id="nombre" data-tcampo="Nombre" autocomplete="off">
          <label>Correo electrónico:</label>
          <input type="email" name="correo" id="correo" data-tcampo="Correo electrónico"
            class="norequired" autocomplete="off">

          <label>Usuario:</label>
          <input type="text" name="usuario" id="usuario" data-tcampo="Usuario" class="required" autocomplete="off">
          <label>Contraseña:</label>
          <input type="password" name="clave" id="clave" data-tcampo="Contraseña" autocomplete="off">

        </div>
        <div class="col-sm-5">
          <div class="clearfix"></div>
          <label>Acceso al Sistema:</label>
          <div class="clearfix"></div>

          <div class="modulos">
            <input id="todos-cb" type="checkbox" name="modulo" value="todos" data-tcampo="Módulos" /><label
              for="todos-cb" class="fw-normal"><span></span> Acceso Completo</label>

            <div class="h20"></div>

            <div class="modulos-ind">
              <?php 
                $modulosx = new Modulos();
                $modulosx->ACheckbox(); 
              ?>
            </div>

            <div class="clearfix"></div>
          </div>

          <div class="h40"></div>

          <label>Permisos:</label>
          <div class="clearfix"></div>
          <div class="permisos">
            <input id='chk98' type='radio' name='permiso' value='1' data-tcampo="Permisos" checked /><label for='chk98'
              class='fw-normal'><span></span> Lectura / Escritura</label>
            <input id='chk99' type='radio' name='permiso' value='2' data-tcampo="Permisos" /><label for='chk99'
              class='fw-normal'><span></span> Soló Lectura</label>
          </div>

          <div class="h40"></div>

        </div>

        <div class="col-sm-offset-9 col-sm-2">
          <a href="javascript:;" class="btn-gral guardar-datos" data-accion="guardar">Guardar</a>
        </div>

      </div>

      <div class="clearfix h30"></div>
    </div>
  </div>
</div>

<div id="alerta-eliminar" style="display: none;" title="Eliminar">
  <p align="center">¿Deseas continuar con la eliminación de<br>
    <b><span id="txtEliminar"></span></b>
    ?</p>
</div>
<div id="alerta2" style="display: none;" title="Seleccionar Módulos">
  <p>Seleccione uno o más módulos</p>
</div>
<div id="alerta3" style="display: none;" title="Error">
  <p>El nombre de usuario ó el correo electrónico ya se encuentran en uso.</p>
</div>
<?php
include '../../includes/_footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript" src="controlador.js"></script>


</body>

</html>