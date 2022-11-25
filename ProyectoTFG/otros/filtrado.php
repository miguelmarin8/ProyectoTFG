<?php

    function filtrado($texto)
    {
        $texto = trim($texto);
        $texto = htmlspecialchars($texto);
        $texto = stripcslashes($texto);
        return $texto;

    }

?>