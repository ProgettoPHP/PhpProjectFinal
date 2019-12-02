<?php 
declare(strict_types=1);

namespace SimpleMVC\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class ErroController implements ControllerInterface
{
	//atencao na construcao que Environment è per twig e engine per plates
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function execute(ServerRequestInterface $request)
    {
        //http_response_code(404);
        //renderiza la view error.html
        $template = $this->twig->load('error.html');
        $template->display();
        
    }
}



