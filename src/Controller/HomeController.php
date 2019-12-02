<?php 
namespace SimpleMVC\Controller;

use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloManager;
use Twig\Environment;

class HomeController implements ControllerInterface
{

	protected $articolo;

	//passo in construzione il model e il twig
	public function __construct(ArticoloManager $articolo, Environment $twig)
	{
		$this->articolo = $articolo;
		$this->twig = $twig;
	}

	//AKI DENTRO EXECUTO MEU CODIGO
	public function execute(ServerRequestInterface $request)
	{
		try{
			
			//renderiza header
			$tpl_menu = $this->twig->load('header.html');
			$tpl_menu->display();
				

			//renderiza view
			$template = $this->twig->load('home.html');
			$parametros = array();
			//prendo param articoli del ciclo for in home.hmtl
			$parametros['articoli'] = $this->articolo->selectAll();

			$conteudo = $template->render($parametros);
			echo $conteudo;

			
		}catch(Exception $e){
			echo $e->getMessage();
		}
		
	}

}
