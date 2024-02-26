<?php
require_once 'includes/_funciones.php';
require_once 'includes/_header.php';
page_protect();
$sql2 = "SELECT COUNT(id_usr) AS total2 FROM usuarios WHERE activo_usr = 1 AND id_usr > 1; ";
$res2 = $db->query($sql2)->fetchAll(PDO::FETCH_ASSOC);
$total2 = $res2[0]['total2'];

?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>Dashboard</h1>
        </div>

        <div class="h20"></div>
        <!-- ********************************************************
                    SECCIÓN DE TOTALES
 ********************************************************-->
        <div class="col-sm-12">
            <a href="<?= base_url ?>modulo/usuarios">
                <div class="boxy accesos-directos">
                    <div class="text">
                        <span>Usuarios</span>
                        activos.
                    </div>
                    <div class="cifra"><?= $total2 ?></div>
                </div>
            </a>
        </div>

        <div class="h40"></div>

        <!-- ********************************************************
                    SECCIÓN DE MÓDULOS DESTACADOS
 ********************************************************-->
        <div class="col-sm-4">
            <a href="<?= base_url ?>modulo/usuarios">
                <div class="modbox">
                    <div class="mod-img">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="mod-title">Usuarios</div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="<?= base_url ?>modulo/blog">
                <div class="modbox">
                    <div class="mod-img">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </div>
                    <div class="mod-title">Blog</div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="<?= base_url ?>modulo/vacantes">
                <div class="modbox">
                    <div class="mod-img">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                    </div>
                    <div class="mod-title">Vacantes</div>
                </div>
            </a>
        </div>

    </div>
</div>
<?php require_once 'includes/_footer.php' ?>

</body>

</html>