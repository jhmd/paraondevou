<?
require_once("dados/class.mysql.php");
$rs = new RecordSet();


function recuperarPontosIniciais() {
	$jsonArray = array();
	if (isset($latitute) && isset($longitude)) {			
		$rs = new RecordSet();	
		
		
		$sql = "SELECT  cnes, nome_de_fantasia, logradouro, numero, complemento, bairro, 
		cep, telefone, latitude, longitude, codigo_esfera_administrativa, 
		esfera_administrativa, codigo_da_natureza_organizacao, natureza_da_organizacao, 
		tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude LIMIT 20";	
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"cnes"                            => $row['cnes'],
				"nome_de_fantasia"                => $row['nome_de_fantasia'],
				"logradouro"                      => $row['logradouro'].", ". $row['numero'],
				"complemento"                     => $row['complemento'],
				"bairro"                          => $row['bairro'],
				"cep"                             => $row['cep'],
				"telefone"                        => $row['telefone'],
				"latitude"                        => $row['latitude'],
				"longitude"                       => $row['longitude'],
				"codigo_esfera_administrativa"    => $row['codigo_esfera_administrativa'],
				"descricao_esfera_administrativa" => $row['esfera_administrativa'],
				"codigo_da_natureza_organizacao"  => $row['codigo_da_natureza_organizacao'],																
				"natureza_da_organizacao"         => $row['natureza_da_organizacao'],																					
				"tipo_da_unidade"                 => $row['tipo_da_unidade'],
				"tipo_de_estabelecimento"         => $row['tipo_de_estabelecimento']				
			);

			$jsonArray[] = $jsonLinha;
		}
	}
	echo json_encode($jsonArray);	
}

function recuperarPontosPorRaio($latitute, $longitude, $raio) {
	$jsonArray = array();
	if (isset($latitute) && isset($longitude)) {			
		$rs = new RecordSet();	
		
		
		$sql = "SELECT  cnes, nome_de_fantasia, logradouro, numero, complemento, bairro, 
		cep, telefone, latitude, longitude, codigo_esfera_administrativa, 
		esfera_administrativa, codigo_da_natureza_organizacao, natureza_da_organizacao, 
		tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude LIMIT 20";	
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"cnes"                            => $row['cnes'],
				"nome_de_fantasia"                => $row['nome_de_fantasia'],
				"logradouro"                      => $row['logradouro'].", ". $row['numero'],
				"complemento"                     => $row['complemento'],
				"bairro"                          => $row['bairro'],
				"cep"                             => $row['cep'],
				"telefone"                        => $row['telefone'],
				"latitude"                        => $row['latitude'],
				"longitude"                       => $row['longitude'],
				"codigo_esfera_administrativa"    => $row['codigo_esfera_administrativa'],
				"descricao_esfera_administrativa" => $row['esfera_administrativa'],
				"codigo_da_natureza_organizacao"  => $row['codigo_da_natureza_organizacao'],																
				"natureza_da_organizacao"         => $row['natureza_da_organizacao'],																					
				"tipo_da_unidade"                 => $row['tipo_da_unidade'],
				"tipo_de_estabelecimento"         => $row['tipo_de_estabelecimento']				
			);

			$jsonArray[] = $jsonLinha;
		}
	}
	echo json_encode($jsonArray);	
}

function recuperarPontosPorTipo($latitute, $longitude, $raio) {
	$jsonArray = array();
	if (isset($latitute) && isset($longitude)) {			
		$rs = new RecordSet();	
		
		
		$sql = "SELECT  cnes, nome_de_fantasia, logradouro, numero, complemento, bairro, 
		cep, telefone, latitude, longitude, codigo_esfera_administrativa, 
		esfera_administrativa, codigo_da_natureza_organizacao, natureza_da_organizacao, 
		tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude LIMIT 20";	
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"cnes"                            => $row['cnes'],
				"nome_de_fantasia"                => $row['nome_de_fantasia'],
				"logradouro"                      => $row['logradouro'].", ". $row['numero'],
				"complemento"                     => $row['complemento'],
				"bairro"                          => $row['bairro'],
				"cep"                             => $row['cep'],
				"telefone"                        => $row['telefone'],
				"latitude"                        => $row['latitude'],
				"longitude"                       => $row['longitude'],
				"codigo_esfera_administrativa"    => $row['codigo_esfera_administrativa'],
				"descricao_esfera_administrativa" => $row['esfera_administrativa'],
				"codigo_da_natureza_organizacao"  => $row['codigo_da_natureza_organizacao'],																
				"natureza_da_organizacao"         => $row['natureza_da_organizacao'],																					
				"tipo_da_unidade"                 => $row['tipo_da_unidade'],
				"tipo_de_estabelecimento"         => $row['tipo_de_estabelecimento']				
			);

			$jsonArray[] = $jsonLinha;
		}
	}
	echo json_encode($jsonArray);	
}

function recuperarPontosPorEsfera($latitute, $longitude, $raio) {
	$jsonArray = array();
	if (isset($latitute) && isset($longitude)) {			
		$rs = new RecordSet();	
		
		
		$sql = "SELECT  cnes, nome_de_fantasia, logradouro, numero, complemento, bairro, 
		cep, telefone, latitude, longitude, codigo_esfera_administrativa, 
		esfera_administrativa, codigo_da_natureza_organizacao, natureza_da_organizacao, 
		tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude LIMIT 20";	
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"cnes"                            => $row['cnes'],
				"nome_de_fantasia"                => $row['nome_de_fantasia'],
				"logradouro"                      => $row['logradouro'].", ". $row['numero'],
				"complemento"                     => $row['complemento'],
				"bairro"                          => $row['bairro'],
				"cep"                             => $row['cep'],
				"telefone"                        => $row['telefone'],
				"latitude"                        => $row['latitude'],
				"longitude"                       => $row['longitude'],
				"codigo_esfera_administrativa"    => $row['codigo_esfera_administrativa'],
				"descricao_esfera_administrativa" => $row['esfera_administrativa'],
				"codigo_da_natureza_organizacao"  => $row['codigo_da_natureza_organizacao'],																
				"natureza_da_organizacao"         => $row['natureza_da_organizacao'],																					
				"tipo_da_unidade"                 => $row['tipo_da_unidade'],
				"tipo_de_estabelecimento"         => $row['tipo_de_estabelecimento']				
			);

			$jsonArray[] = $jsonLinha;
		}
	}
	echo json_encode($jsonArray);	
}

function recuperarPontosPorAvaliacao($latitute, $longitude, $raio) {
	$jsonArray = array();
	if (isset($latitute) && isset($longitude)) {			
		$rs = new RecordSet();	
		
		
		$sql = "SELECT  cnes, nome_de_fantasia, logradouro, numero, complemento, bairro, 
		cep, telefone, latitude, longitude, codigo_esfera_administrativa, 
		esfera_administrativa, codigo_da_natureza_organizacao, natureza_da_organizacao, 
		tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude LIMIT 20";	
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"cnes"                            => $row['cnes'],
				"nome_de_fantasia"                => $row['nome_de_fantasia'],
				"logradouro"                      => $row['logradouro'].", ". $row['numero'],
				"complemento"                     => $row['complemento'],
				"bairro"                          => $row['bairro'],
				"cep"                             => $row['cep'],
				"telefone"                        => $row['telefone'],
				"latitude"                        => $row['latitude'],
				"longitude"                       => $row['longitude'],
				"codigo_esfera_administrativa"    => $row['codigo_esfera_administrativa'],
				"descricao_esfera_administrativa" => $row['esfera_administrativa'],
				"codigo_da_natureza_organizacao"  => $row['codigo_da_natureza_organizacao'],																
				"natureza_da_organizacao"         => $row['natureza_da_organizacao'],																					
				"tipo_da_unidade"                 => $row['tipo_da_unidade'],
				"tipo_de_estabelecimento"         => $row['tipo_de_estabelecimento']				
			);

			$jsonArray[] = $jsonLinha;
		}
	}
	echo json_encode($jsonArray);	
}

function recuperarTiposDeUnidades() {
	$jsonArray = array();
		
		$rs = new RecordSet();	
		$sql = "SELECT DISTINCT tipo_da_unidade, tipo_de_estabelecimento FROM estabelecimento_saude ORDER BY tipo_da_unidade";	
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"tipo_da_unidade"         => $row['tipo_da_unidade'],
				"tipo_de_estabelecimento" => $row['tipo_de_estabelecimento']);

			$jsonArray[] = $jsonLinha;
		}
	echo json_encode($jsonArray);	
}

function recuperarTiposDeEsfera() {
	$jsonArray = array();
		
		$rs = new RecordSet();	
		$sql = "SELECT DISTINCT codigo_esfera_administrativa, esfera_administrativa FROM estabelecimento_saude ORDER BY codigo_esfera_administrativa";
		$result = $rs->select($sql);
	
		while ($row = $rs->setRow($result)) {
	  		$jsonLinha = array(
				"codigo_esfera_administrativa"   => $row['codigo_esfera_administrativa'],
				"esfera_administrativa"          => $row['esfera_administrativa']);

			$jsonArray[] = $jsonLinha;
		}
	echo json_encode($jsonArray);	
}

?>
