<?php //Opciones ?>

	<!-- <div class="h50"></div> -->
	<a href="javascript:;" id="editar-elemento" class="btn-gral eleOpc editar-elemento" style="display: none;"><?= (($txtOpcionEditar == "") ? "Editar" : $txtOpcionEditar ) ?></a>
<?PHP if($valNoDuplicar == ""){ ?>
	<a data-toggle="modal" id="duplicar-elemento" data-target="#formulario-duplicar-landing" href="#" class="btn-gral eleOpc duplicar-elemento" style="display: none;">Duplicar</a>
<?PHP } ?>
<?PHP if($valNoEliminar == ""){ ?>
	<a href="javascript:;" id="eliminar-elemento" class="btn-gral eleOpc eliminar-elemento" data-id="0" style="display: none;">Eliminar</a>
	<a href="javascript:;" id="eliminar-elemento-seleccion" data-total="0" class="btn-gral eleOpcSelecciono eliminar eliminar-elemento-seleccion" data-arreglo="0" style="display: none;">Eliminar (<span id="cantidadEliminar"></span>) </a>
<?PHP } ?>