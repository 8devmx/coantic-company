    </div>
    <div class="h30"></div>
    </div>
    <div id="vtnInfo" class="" style="display: none;" title="Información">
    	<strong><label id="titMsj"></label></strong>
    	<p id="infoMsj"></p>
    </div>
    <div id="alerta-seleccion" class="" style="display: none;" title="Eliminar">
    	<p>¿Deseas continuar con la eliminación de <b><span id="idEliminarSeleccion"></span> elementos</b>?</p>
    </div>

    <footer id="main-footer">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-12">
    				<p><span class="hidden-xs"><?= empresa ?> ® Todos los Derechos Reservados <?= date("Y") ?> • Sistema de uso exclusivo para <?= empresa ?> • Diseño y Desarrollo por: <a href="http://coatincmx.com/">Coatinc</a>
    				</p>
    			</div>
    		</div>
    	</div>
    </footer>

    <!-- Plugin para mostrar mensajes y alertas -->
    <script src="<?= base_url ?>js/sweetalert2.all.min.js"></script><!-- ESTILOS CCS -->
    <script src="<?= base_url ?>js/promise-polyfill.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    	window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?= base_url; ?>js/plugins.js"></script>
    <!-- Plugin para mostrar el tooltip, datepicker de forma correcta -->
    <script src="<?= base_url ?>js/jquery-ui-v1.11.4.js"></script>
    <!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
    <script src="<?= base_url; ?>js/jquery-ui-timepicker-addon.js"></script>
    <script src="<?= base_url; ?>js/calendario.js"></script>
    <script src="<?= versionarArchivo('js/main.js') ?>"></script>
    <script src="<?= base_url; ?>js/jquery.maskedinput.js"></script>

    <!-- Plugin para filtrar(buscar) en las tablas -->
    <script src="<?= base_url; ?>js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?= base_url; ?>js/tablesorter/jquery.tablesorter.pager.js"></script>
    <script src="<?= base_url; ?>js/tablesorter/jquery.tablesorter.widgets.js"></script>