<?php 

namespace SimpleMVC\Model;

use PDO;
use SimpleMVC\Model\Articolo;//prendi della classe Articolo i parametri del db

//CRUD

class ArticoloManager
{
	protected $con;

	public function __construct(PDO $con)
	{
		$this->con = $con;
	}

	//metodo que conecta banco e puxa os registros
	public function selectAll()
	{
		
		$sql ="SELECT * FROM articolo ORDER BY data Desc";
		$sql = $this->con->prepare($sql);
		$sql->execute();

		//inves de retornar 1 array quero q retorne 1 objeto, pega registros do db e converte em objeto atribuindo a row
		//print_r($sql->fetchAll());

		$resultado = array();
		//enqto encontrar resultados no db ele passa pro row a armazena em resultado
		//VEJA AQUI ELE CHAMOU ::class
		while ($row = $sql->fetchObject(Articolo::class)) {
			$resultado[] = $row;
		}

		//se n enontrar nenhum registro no db lanca exececao e para execucao caindo no catch da HomeController
		if (!$resultado) {
			throw new Exception("Non è stato trovato nessuno registro nel database!");
			
		}
		return $resultado;
	}



	//metodo seleziona 1 id di articolo per volta
	public static function selectById($idPost)
	{

		$sql = "SELECT * FROM articolo WHERE id = :id";
		$sql = $this->con->prepare($sql);
		//como utilizamos :id uso bindvalue e tb digo q è valor inteiro
		$sql->bindvalue(':id', $idPost, PDO::PARAM_INT);
		$sql->execute();
		//retorna o objeto da classe Articolo dessa query
		//$resultado = $sql->fetchObject('Articolo'); //prende si è stringa o se Articolo::class uguale
		$resultado = $sql->fetchObject('Articolo');

		if (!$resultado) {//se n encontrar
			throw new Exception("Non è stato trovato nessuno registro nel database!");
		}
		return $resultado;
	}




	public static function insert($dataPost){
		if (empty($dataPost['data']) || empty($dataPost['titolo']) || empty($dataPost['testo'])) {
			throw new Exception("Compilare i campi vuoti");
			return false;
		}
		//altrimenti se esiste inserisce
		$con = Connection::getConn();
		$sql = "INSERT INTO articolo (data,titolo,testo) VALUES (:data,:tit, :test)";
		$sql = $con->prepare($sql);
		$sql->bindvalue(':data',$dataPost['data']);
		$sql->bindvalue(':tit',$dataPost['titolo']);
		$sql->bindvalue(':test',$dataPost['testo']);
		$res= $sql->execute();

		var_dump($res);//se faz insercao retorna true (1) senao false (0)
		if ($res == 0) {
			throw new Exception("Errore nel inserimento dell'articolo"); //NAO TA LENDO ESSES ERROS
			return false;
		}
		return true;//1
	}


	public static function update($params){
	//params tem info do id data titolo e testo q vem ddo _POST
		$con = Connection::getConn();
		$sql = "UPDATE articolo SET data =:data, titolo=:tit, testo=:test WHERE id = :id";
		$sql = $con->prepare($sql);
		$sql->bindvalue(':data',$params['data']);
		$sql->bindvalue(':tit',$params['titolo']);
		$sql->bindvalue(':test',$params['testo']);
		$sql->bindvalue(':id',$params['id']);

		$res= $sql->execute();

		if ($res == 0) {
			throw new Exception("Errore nella modifica dell'articolo");//NAO TA LENDO ESSES ERROS

			return false;
		}
		return true;//1
	}



	public static function delete($id){
	// metodo delete n precisa de view pq ele n vai criar nada so deletar
		$con = Connection::getConn();
		$sql = "DELETE FROM articolo WHERE id = :id";
		$sql = $con->prepare($sql);
		$sql->bindvalue(':id', $id, PDO::PARAM_INT);
		$res= $sql->execute();
		
		if ($res == 0) {
			throw new Exception("Errore nella cancellazione dell'articolo");//NAO TA LENDO ESSES ERROS

			return false;
		}
		return true;//1
	}

}





