<?php

/**
* Calcula o numero de dias entre 2 datas.
* As datas passadas sempre serao validas e a primeira data sempre sera menor que a segunda data.
* @param string $dataInicial No formato YYYY-MM-DD
* @param string $dataFinal No formato YYYY-MM-DD
* @return int O numero de dias entre as datas
**/
function calculaDias($dataInicial, $dataFinal) {
	/*
		- Setembro, abril, junho e novembro tem 30 dias, todos os outros meses tem 31 exceto fevereiro que tem 28, exceto nos anos bissextos nos quais ele tem 29.
		- Os anos bissexto tem 366 dias e os demais 365.
		- Todo ano divisivel por 4 e um ano bissexto.
		- A regra acima não e valida para anos divisiveis por 100. Estes anos devem ser divisiveis por 400 para serem anos bissextos. Assim, o ano 1700, 1800, 1900 e 2100 nao sao bissextos, mas 2000 e bissexto.
		- Não e permitido o uso de classes e funcoes de data da linguagem (DateTime, mktime, strtotime, etc).
	*/
	//variavel de contagem
	$count=0;
	$countDias=0;
	
	//separando as datas em um array
	$ArrayDataInicial = explode("-", $dataInicial);
	$ArrayDataFinal = explode("-", $dataFinal);
	$anoInicial=$ArrayDataInicial[0];
	$anoFinal=$ArrayDataFinal[0];
	
	//diferença de anos
    $anosDiferenca= $ArrayDataFinal[0]-$ArrayDataInicial[0];
        
        //caso não tenha diferença de anos
        if($anosDiferenca==0){
            $mesesDiferenca=$ArrayDataFinal[1]-$ArrayDataInicial[1];
            
            //caso não tenha diferença de meses no meso ano
            if($mesesDiferenca==0){
            $diasDiferenca=$ArrayDataFinal[2]-$ArrayDataInicial[2];
            return($diasDiferenca);
            }
            
            //caso tenha diferença de meses no mesmo ano
            else{
                for ($j = 0; $j <= $mesesDiferenca; $j++) {
                //conferir se o mês tem 30 dias
                if($ArrayDataInicial[1]+$j==9 || $ArrayDataInicial[1]+$j==4 || $ArrayDataInicial[1]+$j==6 || $ArrayDataInicial[1]+$j==11){
                    if($j==0){
                    $countDias+= 30-$ArrayDataInicial[2];
                    }
                    elseif($j==$mesesDiferenca){
                    $countDias+=$ArrayDataFinal[2];
                    }
                    else{
                        $countDias+=30;
                    }
                }
                //conferir se o mes tem 28 ou 29 dias
                elseif(($ArrayDataInicial[1]+$j)==2){
                    if($anoInicial%4==0 && $anoInicial%100 != 0){
                        if($j==0){
                            $countDias+= 29-$ArrayDataInicial[2];
                        }
                        elseif($j==$mesesDiferenca){
                            $countDias+=$ArrayDataFinal[2];
                        }
                        else{
                            $countDias+=29;
                        }
                    }
                    elseif($anoInicial%100 == 0 && $anoInicial%400==0){
                        
                        if($j==0){
                            $countDias+= 29-$ArrayDataInicial[2];
                        }
                        elseif($j==$mesesDiferenca){
                            $countDias+=$ArrayDataFinal[2];
                        }
                        else{
                            $countDias+=29;
                        }
                    }
                    else{
                        if($j==0){
                            $countDias+= 28-$ArrayDataInicial[2];
                        }
                        elseif($j==$mesesDiferenca){
                            $countDias+=$ArrayDataFinal[2];
                        }
                        else{
                            $countDias+=28;
                        }
                    }
                }
                //meses que tem 31 dias
                else{
                    if($j==0){
                    $countDias+= 31-$ArrayDataInicial[2];
                    }
                    elseif($j==$mesesDiferenca){
                    $countDias+=$ArrayDataFinal[2];
                    }
                    else{
                        $countDias+=31;
                    }
                }
                
            }
            return($countDias);
            
        }

    }
    
    //caso tenha diferença de anos
    else{
        //pegar os dias que faltam do mês inicial
        if($ArrayDataInicial[1]==9 || $ArrayDataInicial[1]==4 || $ArrayDataInicial[1]==6 || $ArrayDataInicial[1]==11){
            $countDias+= 30-$ArrayDataInicial[2];
        }
        elseif($ArrayDataInicial[1]==2){
            if($ArrayDataInicial[0]%100==0 && ArrayDataInicial[0]%400==0){
                    $countDias+= 29-$ArrayDataInicial[2];
            }
            elseif($ArrayDataInicial[0]%4==0){
                    $countDias+= 29-$ArrayDataInicial[2];
            }
            else{
                    $countDias+= 28-$ArrayDataInicial[2];
            }
        }
        else{
            $countDias+= 31-$ArrayDataInicial[2];
        }
    
        $mesesDiferenca=12-$ArrayDataInicial[1];
        //somando os dias restantes do ano
        for ($j = 1; $j <= $mesesDiferenca; $j++) {
                //conferir se o mês tem 30 dias
                if($ArrayDataInicial[1]+$j==9 || $ArrayDataInicial[1]+$j==4 || $ArrayDataInicial[1]+$j==6 || $ArrayDataInicial[1]+$j==11){
                        $countDias+=30;
                }
                
                //conferir se o mes tem 28 ou 29 dias
                elseif($ArrayDataInicial[1]+$j==2){
                    if($ArrayDataInicial[0]%100==0 && ArrayDataInicial[0]%400==0){
                            $countDias+=29;
                    }
                    elseif($ArrayDataInicial[0]%4==0){
                            $countDias+=29;
                    }
                    else{
                            $countDias+=28;
                    }
                }
                
                //meses que tem 31 dias
                else{
                        $countDias+=31;
                }
               
            }

        
        
        //somando os dias restantes do ano final
        for ($h = 1; $h < $ArrayDataFinal[1]; $h++) {
                //conferir se o mês tem 30 dias
                if($h==9 || $h==4 || $h==6 || $h==11){
                        $countDias+=30;
                }
                //conferir se o mes tem 28 ou 29 dias
                elseif($h==2){
                    if($ArrayDataFinal[0]%100==0 && $ArrayDataFinal[0]%400==0){
                            $countDias+=29;
                    }
                    elseif($ArrayDataFinal[0]%4==0){
                            $countDias+=29;
                    }
                    else{
                            $countDias+=28;
                    }
                }
                //meses que tem 31 dias
                else{
                        $countDias+=31;
                }
                
            }
            
            
        
        
    }
    
    if($anosDiferenca>1){
    //rodando a diferença de anos
    for ($i = 1; $i < $anosDiferenca; $i++) {    
        if(($ArrayDataInicial[0]+$i)%100==0 && ($ArrayDataInicial[0]+$i)%400==0){
            $countDias+=366;
        }
        elseif(($ArrayDataInicial[0]+$i)%4==0  && ($ArrayDataInicial[0]+$i)%100!=0){
            $countDias+=366;
        }
        else{
            $countDias+=365;
        }
    }
    }
    
    $countDias+=$ArrayDataFinal[2];
    return($countDias);

	
	

}



/***** Teste 01 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-01-02";
$resultadoEsperado = 1;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("01", $resultadoEsperado, $resultado);

/***** Teste 02 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-02-01";
$resultadoEsperado = 31;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("02", $resultadoEsperado, $resultado);

/***** Teste 03 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-02-02";
$resultadoEsperado = 32;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("03", $resultadoEsperado, $resultado);

/***** Teste 04 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2018-02-28";
$resultadoEsperado = 58;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("04", $resultadoEsperado, $resultado);

/***** Teste 05 *****/
$dataInicial = "2018-01-15";
$dataFinal = "2018-03-15";
$resultadoEsperado = 59;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("05", $resultadoEsperado, $resultado);

/***** Teste 06 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2019-01-01";
$resultadoEsperado = 365;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("06", $resultadoEsperado, $resultado);

/***** Teste 07 *****/
$dataInicial = "2018-01-01";
$dataFinal = "2020-01-01";
$resultadoEsperado = 730;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("07", $resultadoEsperado, $resultado);

/***** Teste 08 *****/
$dataInicial = "2018-12-31";
$dataFinal = "2019-01-01";
$resultadoEsperado = 1;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("08", $resultadoEsperado, $resultado);

/***** Teste 09 *****/
$dataInicial = "2018-05-31";
$dataFinal = "2018-06-01";
$resultadoEsperado = 1;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("09", $resultadoEsperado, $resultado);

/***** Teste 10 *****/
$dataInicial = "2018-05-31";
$dataFinal = "2019-06-01";
$resultadoEsperado = 366;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("10", $resultadoEsperado, $resultado);

/***** Teste 11 *****/
$dataInicial = "2016-02-01";
$dataFinal = "2016-03-01";
$resultadoEsperado = 29;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("11", $resultadoEsperado, $resultado);

/***** Teste 12 *****/
$dataInicial = "2016-01-01";
$dataFinal = "2016-03-01";
$resultadoEsperado = 60;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("12", $resultadoEsperado, $resultado);

/***** Teste 13 *****/
$dataInicial = "1981-09-21";
$dataFinal = "2009-02-12";
$resultadoEsperado = 10006;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("13", $resultadoEsperado, $resultado);

/***** Teste 14 *****/
$dataInicial = "1981-07-31";
$dataFinal = "2009-02-12";
$resultadoEsperado = 10058;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("14", $resultadoEsperado, $resultado);

/***** Teste 15 *****/
$dataInicial = "2004-03-01";
$dataFinal = "2009-02-12";
$resultadoEsperado = 1809;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("15", $resultadoEsperado, $resultado);

/***** Teste 16 *****/
$dataInicial = "2004-03-01";
$dataFinal = "2009-02-12";
$resultadoEsperado = 1809;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("16", $resultadoEsperado, $resultado);

/***** Teste 17 *****/
$dataInicial = "1900-02-01";
$dataFinal = "1900-03-01";
$resultadoEsperado = 28;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("17", $resultadoEsperado, $resultado);

/***** Teste 18 *****/
$dataInicial = "1899-01-01";
$dataFinal = "1901-01-01";
$resultadoEsperado = 730;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("18", $resultadoEsperado, $resultado);

/***** Teste 19 *****/
$dataInicial = "2000-02-01";
$dataFinal = "2000-03-01";
$resultadoEsperado = 29;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("19", $resultadoEsperado, $resultado);

/***** Teste 20 *****/
$dataInicial = "1999-01-01";
$dataFinal = "2001-01-01";
$resultadoEsperado = 731;
$resultado = calculaDias($dataInicial, $dataFinal);
verificaResultado("20", $resultadoEsperado, $resultado);


function verificaResultado($nTeste, $resultadoEsperado, $resultado) {
	if(intval($resultadoEsperado) == intval($resultado)) {
		echo "Teste $nTeste passou.\n";
	} else {
		echo "Teste $nTeste NAO passou (Resultado esperado = $resultadoEsperado, Resultado obtido = $resultado).\n";
	}
}

?>