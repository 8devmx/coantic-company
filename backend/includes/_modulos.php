<?php
class Modulos
{
    private $Lista = [
        'dashboard' => ['tipo' => 'modulos', 'nombre' => 'Dashboard'],
        'modulo' => ['tipo' => 'modulos', 'nombre' => 'Modulos', 'submenu' => [
            'blog' => ['nombre' => 'Blog'],
            'vacantes' => ['nombre' => 'Vacantes'],
            'usuarios' => ['nombre' => 'Usuarios'],
        ]],
        'catalogos' => ['tipo' => 'configuracion', 'nombre' => 'Catálogos', 'submenu' => []]
    ];

    private $seccionActual;
    private $seccionConfig;

    private function getSeccionActual($sub = 1)
    {
        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        $seccion = ($sub == 0) ? $segments[count($segments) - 2] : $segments[count($segments) - 1];
        $seccion = trim($seccion, '.php');
        $this->seccionActual = $seccion;
    }

    public function menuModulos($tipo)
    {
        $mod = $this->crearModulos($tipo);
        echo $mod;
    }

    public function seccion()
    {
        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            echo $this->Lista[$segments[2]]["nombre"];
        } else {
            echo $this->Lista[$segments[1]]["nombre"];
        }
    }

    private function crearModulos($tipo)
    {
        global $permiso;
        $this->getSeccionActual();
        // ARRAY de las Secciones Administrables por cada usuario
        $modulosPermitidos = explode("**", $_SESSION['modulos']);

        $html = "";
        if ($_SESSION['modulos'] === "todos") {
            foreach ($this->Lista as $lista => $val) {
                if ($this->Lista[$lista]['tipo'] === $tipo) {

                    $this->getSeccionActual();
                    $class = ($lista === $this->seccionActual) ? 'activo' :  null;
                    // valladolid
                    $submenu = "";
                    $flechaSubmenu = "";
                    $link = ($lista === "dashboard") ?  base_url . 'dashboard' :   base_url . $lista;

                    if (array_key_exists("submenu", $this->Lista[$lista])) {
                        $this->getSeccionActual(0);
                        $class = ($lista === $this->seccionActual) ? 'activo' :  null;

                        $submenu = '<ul class="submenu">';
                        foreach ($this->Lista[$lista]['submenu'] as $listaSub => $valSub) {
                            $nombreSub = $this->Lista[$lista]['submenu'][$listaSub]['nombre'];
                            $submenu .= '<li><a href="' . $link . '/' . $listaSub . '/" title="' . $nombreSub . '"><div class="fix"><span>' . $nombreSub . '</span></div></a></li>';
                        }
                        $submenu .= '</ul>';

                        $link = ($submenu !== "") ? 'javascript:;' :  $link;
                        $flechaSubmenu = '<i class="fa fa-angle-down" aria-hidden="true"></i>';
                    }

                    $class = ($submenu !== "") ? $class . ' multiple' :  $class;

                    $html .= '<li class="' . trim($class) . '"><a href="' . $link . '" title="' . $this->Lista[$lista]['nombre'] . '"><div class="fix"><span>' . $this->Lista[$lista]['nombre'] . '</span>' . $flechaSubmenu . '</div></a>
                        ' . $submenu . '
                        </li>';
                }
            }
        } else {
            foreach ($modulosPermitidos as $permiso) {
                if ($this->Lista[$permiso]['tipo'] === $tipo) {
                    $this->getSeccionActual();
                    $class = ($permiso === $this->seccionActual) ? 'activo' :  null;
                    $link = ($permiso === "dashboard") ?  base_url . 'dashboard' :  base_url . 'modulo/' . $permiso . '/';

                    $submenu = "";
                    $flechaSubmenu = "";
                    if (array_key_exists("submenu", $this->Lista[$permiso])) {
                        $this->getSeccionActual(0);
                        $class = ($permiso === $this->seccionActual) ? 'activo' :  null;

                        $submenu = '<ul class="submenu">';
                        foreach ($this->Lista[$permiso]['submenu'] as $listaSub => $valSub) {

                            $nombreSub = $this->Lista[$permiso]['submenu'][$listaSub]['nombre'];

                            $submenu .= '<li><a href="' . $link . '/' . $listaSub . '/" title="' . $nombreSub . '"><div class="fix"><span>' . $nombreSub . '</span></div></a></li>';
                        }
                        $submenu .= '</ul>';
                        $link = ($submenu !== "") ? 'javascript:;' :  $link;
                        $flechaSubmenu = '<i class="fa fa-angle-down" aria-hidden="true"></i>';
                    }

                    $class = ($submenu !== "") ? $class . ' multiple' :  $class;

                    $html .= '<li class="' . trim($class) . '"><a href="' . $link . '" title="' . $this->Lista[$permiso]['nombre'] . '"><div class="fix"><span>' . $this->Lista[$permiso]['nombre'] . '</span>' . $flechaSubmenu . '</div></a>' . $submenu . '</li>';
                }
            }
        }
        return $html;
    }
    public function aCheckbox()
    {
        $modulos = $this->Lista;
        $pos = 1;
        foreach ($modulos as $url => $contenido) {
            $this->crearSecccionCheckBox($url, $contenido["nombre"], $pos);
            $pos++;
        }
    }

    private function crearSecccionCheckBox($url, $nombre, $pos)
    {
        if ($url !== "dashboard")
            echo "<div class='modulo'><input id='chk{$pos}' type='checkbox' name='modulo' value='{$url}' /><label for='chk{$pos}' class='fw-normal'><span></span> {$nombre}</label></div>";
    }
}
