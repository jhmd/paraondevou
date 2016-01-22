<?
require_once("metodos.php");


$operacao = $_GET['operacao'];

if(isset($operacao)){

	switch ($operacao) {

		case "recuperarPontosIniciais":
			
			recuperarPontosIniciais();
			break;

		case "recuperarpontosporraio":
			
	        $latitute  = $_GET['latitute'];
	        $longitude = $_GET['longitude'];
	        $raio      = $_GET['raio'];

			recuperarPontosPorRaio($latitute, $longitude, $raio);
			break;

	    case "recuperarpontosportipo":        
	        
	        $latitute  = $_GET['latitute'];
	        $longitude = $_GET['longitude'];
	        $raio      = $_GET['raio'];

			recuperarPontosPorTipo($latitute, $longitude, $raio);
	        break;
	    
	    case "recuperarpontosporesfera":
	        
	        $latitute  = $_GET['latitute'];
	        $longitude = $_GET['longitude'];
	        $raio      = $_GET['raio'];

	        recuperarPontosPorEsfera($latitute, $longitude, $raio);;
	        break;

	    case "recuperarpontosporavaliacao":
	    	
	    	$latitute  = $_GET['latitute'];
	        $longitude = $_GET['longitude'];
	        $raio      = $_GET['raio'];

	        recuperarPontosPorAvaliacao($latitute, $longitude, $raio);;
	    	break;
	    
	    case "recuperartiposdeunidades":
	        
	        recuperarTiposDeUnidades();
	        break;

	    case "recuperartiposdeesfera":
	        
	        recuperarTiposDeEsfera();
	        break;	    

	    default:
	        echo("{erro:acesso negado}");
	}

}else
{
	echo("{erro:acesso negado}");
}



?>
