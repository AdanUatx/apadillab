<?php

session_destroy();
// Redireccionar al usuario a la página de inicio de sesión u otra página
header('Location: login');
exit;
?>