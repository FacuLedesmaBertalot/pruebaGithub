<?php
include_once("wordix.php");


/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
// Ledesma, Facundo Nehuen. FAI - 4238. Tecnicatura en Desarrollo Web. faculedesmabertalot@gmail.com . FacuLedesmaBertalot
// Maitena Durand. FAI - 5098. Tecnicatura en Desarrollo Web. maitenadurand@gmail.com . maitenadurand


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/** Obtiene una colección de palabras
 * @return array
 */
    function cargarColeccionPalabras()
    {
        $coleccionPalabras = [
            "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
            "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
            "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
            "CALOR", "OJERA", "PESOS", "LOCRO", "PASTO",
            "LINDO"
        ];

        return $coleccionPalabras;
    }

/** Inicializa una estructura de datos con ejemplos de Partidas
 * @return array
 */
    function cargarPartidas() {
        $cargarPartidas = [];
        $cargarPartidas[0] = ["palabraWordix"=> "QUESO", "jugador"=> "majo", "intentos"=> 0, "puntaje"=> 0];
        $cargarPartidas[1] = ["palabraWordix"=> "MUJER", "jugador"=> "majo", "intentos"=> 6, "puntaje"=> 0];
        $cargarPartidas[2] = ["palabraWordix"=> "GATOS", "jugador"=> "kevin", "intentos"=> 5, "puntaje"=> 2];
        $cargarPartidas[3] = ["palabraWordix"=> "MELON", "jugador"=> "kevin", "intentos"=> 6, "puntaje"=> 0];
        $cargarPartidas[4] = ["palabraWordix"=> "QUESO", "jugador"=> "kevin", "intentos"=> 1, "puntaje"=> 6];
        $cargarPartidas[5] = ["palabraWordix"=> "PESOS", "jugador"=> "santiago", "intentos"=> 6, "puntaje"=> 0];
        $cargarPartidas[6] = ["palabraWordix"=> "FUEGO", "jugador"=> "santiago", "intentos"=> 2, "puntaje"=> 5];
        $cargarPartidas[7] = ["palabraWordix"=> "LOCRO", "jugador"=> "santiago", "intentos"=> 6, "puntaje"=> 0];
        $cargarPartidas[8] = ["palabraWordix"=> "PIANO", "jugador"=> "lucia", "intentos"=> 0, "puntaje"=> 0];
        $cargarPartidas[9] = ["palabraWordix"=> "PASTO", "jugador"=> "lucia", "intentos"=> 2, "puntaje"=> 5];
        $cargarPartidas[10]= ["palabraWordix"=> "QUESO", "jugador"=> "martin", "intentos"=>2,"puntaje"=>5];
        $cargarPartidas[11]= ["palabraWordix"=> "PASTO", "jugador"=> "martin", "intentos"=>4,"puntaje"=>3];
        $cargarPartidas[12]= ["palabraWordix"=> "FUEGO", "jugador"=> "luciana", "intentos"=>1,"puntaje"=>6];
        $cargarPartidas[13]= ["palabraWordix"=> "QUESO", "jugador"=> "maria", "intentos"=>2,"puntaje"=>5];
        $cargarPartidas[14]= ["palabraWordix"=> "LINDO", "jugador"=> "maria", "intentos"=>4,"puntaje"=>3];
        $cargarPartidas[15]= ["palabraWordix"=> "YUYOS", "jugador"=> "marcos", "intentos"=>2,"puntaje"=>5]; 
        
        return $cargarPartidas;   
    }


/** Muestra las opciones del menú
 * @return int
 */
    function seleccionarOpcion() {

        echo "\nMenú de opciones: \n";
        echo "1) Jugar al wordix con una palabra elegida: \n";
        echo "2) Jugar al wordix con una palabra aleatoria: \n";
        echo "3) Mostrar una partida: \n";
        echo "4) Mostrar la primer partida ganadora: \n";
        echo "5) Mostrar resumen de Jugador: \n";
        echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra: \n";
        echo "7) Agregar una palabra de 5 letras a Wordix: \n";
        echo "8) Salir. \n";
        $opcionFinal = trim(fgets(STDIN));

        return $opcionFinal;
    }


/** Se le solicita al usuario un número de partida y se muestra en pantalla
 * @param array $partidas
 * @param int $num
 */
    function mostrarPartida($partidas, $num) {  // * recorrido parcial * // 
        // int $numPartida, $n, $i
            $i = $num - 1;

            echo "***************************************************\n";
            echo "Partida WORDIX ". $num . ": palabra ". $partidas[$i]["palabraWordix"] . "\n";
            echo "Jugador: ". $partidas[$i]["jugador"] ."\n";
            echo "Puntaje: ". $partidas[$i]["puntaje"] . " puntos\n";
            
            if ($partidas[$i]["intentos"] != 0) {
                echo "Adivinó la palabra en ". $partidas[$i]["intentos"] ." intentos.\n";
            
            }
            else {
                echo "No adivinó la palabra\n";
                
            }
            echo "***************************************************\n";
        }


/** Dada una colección de partidas retorna el índice de la primer partida ganada, y si no ganó ninguna retorna el valor -1
 * @param array $partidas
 * @param string $nombre
 * @return int
 */
    function primerPartidaGanada($partidas, $nombre) {
        // int $indice
        // bool $encontrada

        $indice = -1;
        $encontrada = false;
        $i = 0;
        $cantPartidas = count($partidas);

        while ( $i < $cantPartidas &&  !$encontrada){

            if ($partidas[$i]["jugador"] == $nombre && $partidas[$i]["puntaje"] > 0) {

                    $indice = $i + 1;
                    $encontrada = true;
                }
            }
            $i++;

            return $indice;
        }
        
    


/** Función que solicita el nombre del jugador
 * @return bool
 */
    function solicitarJugador() {
        // bool $usuario

        $usuario = true;
        echo "Nombre del Jugador: ";
        $usuario = trim(fgets(STDIN));

        while (ctype_alpha($usuario) == false) {
            echo "Por favor, ingrese un nombre válido que comience con una letra: \n";
            echo "Nombre del Jugador: ";
            $usuario = trim(fgets(STDIN));
        }
        return strtolower($usuario);     
        
    }


/**
 * Funcion que retorna falso si la palabra no se encuentra en la lista y verdadero si dicha palabra se encuentra
 * @param array $coleccionPalabras
 * @param string $palabra
 * @return boolean
 */
    function existePalabra ($coleccionPalabras, $palabra){
        //BOOLEAN $encontrada
        // INT $i, $cant
        
        $encontrada = false;
        $i = 0;
        $cant = count($coleccionPalabras);
        while ($i < $cant  &&  !$encontrada){
        
            if ($coleccionPalabras[$i] == $palabra){
                $encontrada = true;
            }
            $i++;
        }

        return $encontrada;
    }


/** Agrega una palabra nueva al arreglo de la colección de palabras
 * @param array $coleccionPalabras
 * @param string $palabra
 * @return array
*/
    function agregarPalabra ($coleccionPalabras, $palabra){
    // INT $nuevaPosicion

    $nuevaPosicion = count($coleccionPalabras);
    $coleccionPalabras[$nuevaPosicion] = $palabra;

    return $coleccionPalabras;

    }


/** Agrega una partida que se jugó al arreglo
 * @param array $coleccionPartidas
 * @param array $nuevaPartida
 * @return array
 */
    function agregarPartida($coleccionPartidas, $nuevaPartida) {

        $coleccionPartidas[] = $nuevaPartida;

        return $coleccionPartidas;
    }



/** Almacena las estadísticas del jugador
 * @param array $partidas
 * @param string $jugador
 * @return array
 */
    function estadisticasJugador($partidas, $jugador){

        $intento1 = 0;
        $intento2 = 0;
        $intento3 = 0;
        $intento4 = 0;
        $intento5 = 0;
        $intento6 = 0;
        $victoriaJugador = 0;
        $puntajeTotal = 0;
        $partidasJugadas = 0;
    
        foreach ($partidas as $partida) {  

            if ($partida["jugador"] == $jugador){
                $partidasJugadas = $partidasJugadas + 1;
                $puntajeTotal = $puntajeTotal + $partida["puntaje"];
                
                if ($partida["puntaje"] > 0){
                    $victoriaJugador = $victoriaJugador + 1;
                }

                $numeroInt = $partida["intentos"];

                    if ($numeroInt == 1) {
                        $intento1 = $intento1 + 1;
                    }
                    elseif ($numeroInt == 2) {
                        $intento2 = $intento2 + 1;
                    }
                    elseif ($numeroInt == 3) {
                        $intento3 = $intento3 + 1;
                    }
                    elseif ($numeroInt == 4) {
                            $intento4 = $intento4 + 1;
                    }
                    elseif ($numeroInt == 5) {
                            $intento5 = $intento5 + 1;
                    }
                    elseif ($numeroInt == 6 && $partida["puntaje"]> 0) {
                            $intento6 = $intento6 + 1;         
                    } 
               
                $porcVictoria = ($victoriaJugador * 100) / $partidasJugadas;
            }
           
        }
    
        
        $resumen = [
            'jugador' => $jugador, 'partidas'=> $partidasJugadas, 'puntaje' => $puntajeTotal,'victorias' => $victoriaJugador,
            'porcentajeVictorias' => $porcVictoria, 'intento1' => $intento1, 'intento2' => $intento2, 'intento3' => $intento3, 
            'intento4' => $intento4, 'intento5' => $intento5, 'intento6' => $intento6
        ];
        return $resumen;
    }
    


/** Muestra el resumen de un jugador de una forma legible para el usuario
 * @param array $resumen
 * 
 */
    function mostrarResumen($resumen) {  
            echo "***************************************************\n";
            echo "Jugador: ". $resumen["jugador"] . "\n";
            echo "Partidas: ". $resumen["partidas"] . "\n";
            echo "Puntaje Total: ". $resumen["puntaje"] . "\n";
            echo "Victorias: ". $resumen["victorias"] . "\n";
            echo "Porcentaje victorias: ". (int)$resumen['porcentajeVictorias'] . "%.\n";
            echo "Adivinadas: \n";
            echo "      Intento 1: ". $resumen['intento1'] . "\n";
            echo "      Intento 2: ". $resumen['intento2'] . "\n";
            echo "      Intento 3: ". $resumen['intento3'] . "\n";
            echo "      Intento 4: ". $resumen['intento4'] . "\n";
            echo "      Intento 5: ". $resumen['intento5'] . "\n";
            echo "      Intento 6: ". $resumen['intento6'] . "\n";
            echo "***************************************************\n";
        
        }


/** Compara por letras del abecedario los nombres de los jugadores, en caso de ser iguales compara por palabra
 * @param string $partida1
 * @param string $partida2
 * @return int 
 */
    function compararJugadorPartida($partida1, $partida2) {
        if ($partida1['jugador'] == $partida2['jugador']) {
            if ($partida1['palabraWordix'] == $partida2['palabraWordix']) {
                $cmp =0;
            } elseif ($partida1['palabraWordix'] < $partida2['palabraWordix']) {
                $cmp =-1;
                
            }else {
                $cmp =1;

            }
        }
        if ($partida1['jugador'] < $partida2['jugador']) {
                 $cmp =-1;

            }else {
                 $cmp =1;
        }
            return$cmp;
        }
        
      
    

    
/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/**Declaración de variables:
ARRAY $palabras, $partidas, $palabraSeleccionada, $partida, $resumen
INT $opcion, $aleatoria
STRING $num, $numSolicitado, $mostrar, $nuevaPalabra
BOOL $usuario, $existe

//Inicialización de variables:
*/

    $palabras = cargarColeccionPalabras();
    $partidas = cargarPartidas();
    $usuario = solicitarJugador();
    escribirMensajeBienvenida($usuario);
    $palabraSeleccionada = [];
    $palabraAleatoria = [];

    do {
        $opcion = seleccionarOpcion();
        switch ($opcion) {

            case 1: 
                //jugar con palabra elegida
                $usuario = solicitarJugador();
                $num = solicitarNumeroEntre(0, count($palabras) -1);
                 
                while (in_array($num, $palabraSeleccionada)) { // in_array: recorre el array $palabraSeleccionada y se fija si el $num ya existe en él
                    echo "El número de palabra ya fue seleccionado por el jugador. \n";
                    echo "Elija otro número de palabra: ";
                    $num = trim(fgets(STDIN));
                }

                $palabraSeleccionada[] = $num;

                $partida = jugarWordix($palabras[$num], $usuario);
                $partidas = agregarPartida($partidas, $partida);  

                break;

            case 2:
                //jugar con una palabra aleatoria
                $usuario = solicitarJugador();
                $aleatoria = rand(0, count($palabras) - 1);     // rand: algoritmo que obtiene un número aleatorio sin que se repita
                
                while (in_array($palabras[$aleatoria], $palabraAleatoria)) { 
                    echo "\nYa utilizó todas las palabras. \n";
                    break;
                } 

                $palabraAleatoria[] = $palabras[$aleatoria];

                $partida = jugarWordix($palabras[$aleatoria], $usuario);
                $partidas = agregarPartida($partidas, $partida);  
                
                break;

            case 3:
                //mostrar una partida
                $numSolicitado = solicitarNumeroEntre(1, count($partidas));
                $mostrar = mostrarPartida($partidas, $numSolicitado); 
                
                break;
                
            case 4:
                //mostrar primera partida ganadora
                echo "\nIngrese el nombre del jugador que desea observar su primer victoria: ";
                $jugador = trim(fgets(STDIN)); 
                $primerPartidaGanada = primerPartidaGanada($partidas, $jugador);

                if ($primerPartidaGanada == -1) {

                    echo "El jugador ". $jugador . " no ganó ninguna partida. \n";
                } else {

                    $mostrar = mostrarPartida($partidas, $primerPartidaGanada);     
                }

                break;

            case 5: 
                //mostrar estadisticas jugador
                $usuario = solicitarJugador();
                $resumen = estadisticasJugador($partidas, $usuario);

                mostrarResumen($resumen);

                break;

            case 6:
                // mostrar lista ordenada por nombre
                uasort($partidas, 'compararJugadorPartida');
                print_r($partidas);
              
               break;

            case 7:
                // agregar palabra al juego
                $nuevaPalabra = leerPalabra5Letras();
                $existe = existePalabra($palabras,$nuevaPalabra);

                if ($existe == true){
                    echo "La palabra ya se encuentra en la lista.\n";
                }else {
                    $palabras = agregarPalabra($palabras,$nuevaPalabra);
                }
                
                break;

            case 8:
                // salir del programa
                echo "Saliendo del programa. ";
                exit;
            
            }
        
        } while ($opcion != 0);

?>