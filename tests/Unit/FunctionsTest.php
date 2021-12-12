<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGenerateBingoNumberRandom()
    {
        // El helper solo puede recibir las letras de la palabra BINGO
        $numberRandomOfBingo = generateBingoNumberRandom('B');
        $this->assertIsInt($numberRandomOfBingo);
        // Cuando mandamos una letra que no coincida con BINGO nos devuelve un objeto de error
        $numberRandomOfBingoError = generateBingoNumberRandom('Z');
        $this->assertIsArray($numberRandomOfBingoError);
    }

    public function testValidatePlayerWin() {
        // El helper recibe 3 parametros y funciona para 2 casos de uso distintos
        // 1. Validar que un jugador ganó con BINGO de 1 columna
        // 2. Validar que un jugador ganó con BINGO de la cartilla completa
        // Parametros del helper:
        // a-> array de numeros a validar en la cartilla
        // b-> numeros que ya se dictaron en el juego
        // c-> cantidad de numeros iguales que deben haber entre ambos arrays


        $arrayNumerosEnUnaColumna = [
            1,2,3,4,5
        ];

        $arrayNumerosEnUnaCartilla = [
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24
        ];

        $arrayNumerosReveladosEnElJuego = [
          1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24
        ];

        $cantidadDeNumerosAcomparar = 5;


        // Ganó con una columna
        $validatePlayerWin = validatePlayerWin($arrayNumerosEnUnaColumna, $arrayNumerosReveladosEnElJuego, $cantidadDeNumerosAcomparar);
        $this->assertTrue($validatePlayerWin);

        // Ganó con la cartilla completa, se establece la cantidad a comparar en 4 por qué solo hay 24 numeros en una cartilla
        // El elemento 25 no cuenta como número ya que va al centro y es FREE
        $cantidadDeNumerosAcomparar = 24;
        $validatePlayerWinCase2 = validatePlayerWin($arrayNumerosEnUnaCartilla, $arrayNumerosReveladosEnElJuego, $cantidadDeNumerosAcomparar);
        $this->assertTrue($validatePlayerWinCase2);
    }
}
