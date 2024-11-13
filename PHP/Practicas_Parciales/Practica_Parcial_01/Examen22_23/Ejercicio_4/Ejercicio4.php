<?php

    $arrayNumeros = [2,5,100,53,1,6,9,1658];


    echo limitesArray($arrayNumeros);


    function limitesArray($arrayNumeros){
        $valorMenor = $arrayNumeros[0];
        for ($i=0; $i < sizeof($arrayNumeros); $i++) { 
            if($valorMenor > $arrayNumeros[$i]){
                $valorMenor = $arrayNumeros[$i];
            }
        }
        $valorMayor = $arrayNumeros[0];
        for ($i=0; $i < sizeof($arrayNumeros); $i++) { 
            if($valorMayor < $arrayNumeros[$i]){
                $valorMayor = $arrayNumeros[$i];
            }
        }

        echo "<p>El limite inferior del array es $valorMenor</p><br>";
        echo "<p>El limite superior del array es $valorMayor</p>";
    }

    
    $numElementos = 15;
  
    $Valores = array();
    for ($i = 0; $i < $numElementos; $i ++) {
        $Valores[$i] = rand(0, 500);
    }

    foreach ($Valores as $valor){
        echo "$valor ";
    } 

    limitesArray($Valores);
?>