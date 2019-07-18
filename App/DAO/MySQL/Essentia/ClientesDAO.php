<?php

namespace App\DAO\MySQL\Essentia;

use App\Models\MySQL\Essentia\ClienteModel;

class ClientesDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllClientes(): array
    {
        $clientes = $this->pdo
            ->query("SELECT cli_id
                           ,cli_nome
                           ,cli_email
                           ,cli_telefone
                           ,cli_path_foto
                           ,cli_data_cad
                       FROM clientes 
                    ORDER BY cli_id ASC;")
            ->fetchAll(\PDO::FETCH_ASSOC);

        return $clientes;
    }

    public function getClienteByIdReturnModel(string $cli_id): ?ClienteModel
    {
        $statement = $this->pdo
            ->query("SELECT cli.cli_id
                           ,cli.cli_nome
                           ,cli.cli_email
                           ,cli.cli_telefone
                           ,cli.cli_path_foto
                           ,cli.cli_data_cad
                       FROM clientes cli
                      WHERE cli.cli_id = " . $cli_id);

        $statement->execute();
        $clientes = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if(count($clientes) === 0){
            return null;
        }
        else{
            $cliente = new ClienteModel();
            $cliente->setId($clientes[0]['cli_id'])
                    ->setNome($clientes[0]['cli_nome'])
                    ->setEmail($clientes[0]['cli_email'])
                    ->setTelefone($clientes[0]['cli_telefone'])
                    ->setPathImg($clientes[0]['cli_path_foto'])
                    ->setDataCad($clientes[0]['cli_data_cad']);
            return $cliente;
        }
    }

    public function getClienteById(string $cli_id)
    {
        try{
            $statement = $this->pdo
            ->query("SELECT cli.cli_id
                           ,cli.cli_nome
                           ,cli.cli_email
                           ,cli.cli_telefone
                           ,cli.cli_path_foto
                           ,cli.cli_data_cad
                       FROM clientes cli
                      WHERE cli.cli_id = " . $cli_id);

            $statement->execute();
            $clientes = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if(count($clientes) === 0){
                echo '{"error":{"text":null}}';
            }
            else{
                echo json_encode($clientes[0]); 
            }
        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function getClienteByName(string $cli_nome): Array
    {
        $query = "SELECT cli.cli_id
                        ,cli.cli_nome
                        ,cli.cli_email
                        ,cli.cli_telefone
                        ,cli.cli_path_foto
                        ,cli.cli_data_cad
                    FROM clientes cli
                WHERE cli.cli_nome like'%" . $cli_nome . "%'";

        $statement = $this->pdo->query($query);

        $statement->execute();
        $clientes = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $clientes;
    }

    public function insertCliente(ClienteModel $cliente): void
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO clientes (cli_nome
                                  ,cli_email
                                  ,cli_telefone
                                  ,cli_path_foto) 
                           VALUES(:cli_nome
                                 ,:cli_email
                                 ,:cli_telefone
                                 ,:cli_path_foto);'
        );

        $statement->execute(['cli_nome' => $cliente->getNome()
                            ,'cli_email' => $cliente->getEmail()
                            ,'cli_telefone' => $cliente->getTelefone()
                            ,'cli_path_foto' => $cliente->getPathImg()
        ]);
    }

    public function updateCliente(ClienteModel $cliente): void
    {
        $statement = $this->pdo->prepare(
            "UPDATE clientes SET cli_nome=:cli_nome
                                ,cli_email=:cli_email
                                ,cli_telefone=:cli_telefone
              WHERE cli_id=:cli_id");

        $statement->execute(['cli_nome' => $cliente->getNome()
                            ,'cli_email' => $cliente->getEmail()
                            ,'cli_telefone' => $cliente->getTelefone()
                            ,'cli_id' => $cliente->getId()
        ]);
    }

    public function deleteCliente(int $cli_id): void
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM clientes WHERE cli_id = :cli_id;");

        $statement->execute([
            "cli_id" => $cli_id
        ]);
    }
}
