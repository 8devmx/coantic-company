<?php 
if ($_SESSION['session'] != "admin") {
    header("Location: " . base_url);
}

if (in_array("todos", $sec) || in_array($seccion_actual, $sec)) {
    echo "simon tengo acceso";
}else{
	header("Location: " . base_url);
}

// else if($_SESSION['nivel'] !== "1" && $seccion_actual === "usuarios"){
//     header("Location: " . base_url);
// }else if (in_array("todos", $sec) || in_array($seccion_actual, $sec)) {
    
// }else{
//     header("Location: " . base_url);
// }
