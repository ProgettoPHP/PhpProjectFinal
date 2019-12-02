<?php
use SimpleMVC\Controller\HomeController;
use SimpleMVC\Controller\PostController;
use SimpleMVC\Controller\AboutController;
use SimpleMVC\Controller\AdminController;
use SimpleMVC\Controller\ErroController;

return [
    'GET /' => HomeController::class, // corrisponde a "SimpleMVC\Controller\HomeController"
];

return [
    'GET /?pagina=about'=> AboutController::class,// . ':execute'
];


// return [
//     'GET /' => ErroController::class, 
// ];

//-------------------------------------------------

//funciona mas tenho que juntar no execute as demais funcoes listadas no Admin
// return [
//     'GET /' => AdminController::class, 
// ];


//NAO FUNCIONA PQ TM PARAMETROS NA FUNCAO
return [
    'GET /' => PostController::class, 
];
