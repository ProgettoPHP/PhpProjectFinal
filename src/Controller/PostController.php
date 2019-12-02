<?php 
namespace SimpleMVC\Controller;

use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloManager;
use Twig\Environment;


class PostController implements ControllerInterface
{
	protected $articolo;

	//passo in construzione model e twig
	public function __construct(ArticoloManager $articolo, Environment $twig)
	{
		$this->articolo = $articolo;
		$this->twig = $twig;

	}

	//AKI DENTRO EXECUTO MEU CODIGO VEJA Q TEM PARAMS AKI
	public function execute(ServerRequestInterface $request)
	{
		try{
			
			//renderiza header
			$tpl_menu = $this->twig->load('header.html');
			$tpl_menu->display();

			// //renderiza title
			// $title = $this->twig->load('single.html');
			// $param = array('TITLE'=>'Quotidiano Online');
			// echo $title->render($param);

			//------------------------------------------

			//ver modo de pescar as variaveis do db atraves do metodo selectbyId classe Manage e botar no array $post
			$post = $this->articolo->selectAll();
			//$post = $this->articolo->selectById();
			echo "<pre>";
			//print_r($post);	
			echo "</pre>";


			//renderiza view corrisp all singolo articolo 
			$template = $this->twig->load('single.html');

			// $parametros = array(
			// 	'TESTO'=>'texto article',
			// 	'IMAGE'=>'imagem artigo',
			// 'TITLE'=>'Quotidiano Online');

			//PASSO para as variaveis twig da single os valores que pesquei do db e botei no $post

			//$parametros['ID'] = $post->id;
			$parametros['TITOLO'] = $post[1];
			// $parametros['TESTO'] = $post->testo;
			// //$parametros['NAME'] = $post->name;
			// $parametros['IMAGE'] = $post->image;
				
			echo $template->render($parametros);
			
						
			//$parametros['id'] = $this->articolo->selectById($params);

		}catch(Exception $e){
			echo $e->getMessage();
		}
		
	}
}



