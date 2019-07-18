<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\Essentia\ClientesDAO;
use App\Models\MySQL\Essentia\ClienteModel;
use ErrorException;

final class ClienteController
{
    public function getClientes(Request $request, Response $response, array $args): Response
    {       
        $clientesDAO = new ClientesDAO();
        $clientes = $clientesDAO->getAllClientes();
        $response = $response->withJson($clientes);

        return $response;
    }

    public function getClienteById(Request $request, Response $response, array $args): ?ClienteModel
    {   
        $route = $request->getAttribute('route');
        $cli_id = $route->getArgument('cli_id');

        $clientesDAO = new ClientesDAO();
        $cliente = $clientesDAO->getClienteById($cli_id);  

        return $cliente;
    }

    public function getClienteByName(Request $request, Response $response, array $args): Response
    {   
        $route = $request->getAttribute('route');
        $cli_nome = $route->getArgument('cli_nome');

        $clientesDAO = new ClientesDAO();
        $cliente = $clientesDAO->getClienteByName($cli_nome);  
        $response = $response->withJson($cliente);
        
        return $response;
    }

    public function insertCliente(Request $request, Response $response, array $args): Response
    {
        $file = $request->getUploadedFiles();

        /*$name = 'debug_file.txt';
        $text = var_export($file, true);
        $file = fopen($name, 'a');
        fwrite($file, $text);
        fclose($file);*/

        if(!empty($file['imagem'])){
            $imagem = $file['imagem'];
        }
        try{            
            $pathImg = "";
            if(isset($imagem)){
                //sobe a imagem
                $fileName = $imagem->getClientFilename();
                $pathImg = getenv("ESSENTIA_PATH_IMG"); 
                $pathImg.= uniqid('img-'.date('Ymd').'-');
                $pathImg.= $fileName;
                $imagem->moveTo($pathImg);
            }

            //persiste os dados
            $params = $request->getParsedBody();
            $cliente = new ClienteModel();
            $cliente->setNome($params['cli_nome'])
                    ->setEmail($params['cli_email'])
                    ->setTelefone($params['cli_telefone'])
                    ->setPathImg($pathImg);
            
            $clientesDAO = new ClientesDAO();
            $clientesDAO->insertCliente($cliente);

            $response = $response->withJson([
                'message' => 'Cliente inserido com sucesso!'
            ]);
        }
        catch(ErrorException $ex){
            $response = $response->withJson([
                'message' => $ex->getMessage()
            ]);
        }

        return $response;
    }

    public function updateCliente(Request $request, Response $response, array $args): Response
    {
        $params = $request->getParsedBody();

        if(isset($params['cli_id'])){

            $cli_id = $params['cli_id'];
            $clientesDAO = new ClientesDAO();
            $cliente = $clientesDAO->getClienteByIdReturnModel($cli_id);  

            if(!empty($params['cli_nome']))
                $cliente->setNome($params['cli_nome']);
            
            if(!empty($params['cli_email']))
                $cliente->setEmail($params['cli_email']);
            
            if(!empty($params['cli_telefone']))
                $cliente->setTelefone($params['cli_telefone']);
            
            $clientesDAO = new ClientesDAO();
            $clientesDAO->updateCliente($cliente);
    
            $response = $response->withJson([
                'message' => 'Cliente alterado com sucesso!'
            ]);

        }
        else{
            $response = $response->withJson([
                'message' => 'Atenção! Nenhum registro alterado. Não foi encontrado cliente com o ID especificado.'
            ]);
        }

        return $response;
    }

    public function deleteCliente(Request $request, Response $response, array $args): Response
    {
        if(!empty($args['cli_id'])){
            
            $cli_id = $args['cli_id'];
            $clientesDAO = new ClientesDAO();
            $cliente = $clientesDAO->getClienteByIdReturnModel($cli_id); 

            if(!empty($cliente)){

                $clientesDAO = new ClientesDAO();
                $clientesDAO->deleteCliente($cli_id);
                \unlink($cliente->getPathImg());
        
                $response = $response->withJson([
                    'message' => 'Cliente excluído com sucesso!'
                ]);
            }
            else{
                
                $response = $response->withJson([
                    'message' => 'Atenção! Nenhum registro alterado. Não foi encontrado cliente com o ID especificado.'
                ]);
            }
        }
        else{
            $response = $response->withJson([
                'message' => 'Atenção! Nenhum registro alterado. Não foi encontrado cliente com o ID especificado.'
            ]);
        }

        return $response;
    }
}
