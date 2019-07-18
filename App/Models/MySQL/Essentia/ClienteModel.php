<?php

namespace App\Models\MySQL\Essentia;

final class ClienteModel
{
    /**
     * @var int
     */
    private $cli_id;
    /**
     * @var string
     */
    private $cli_nome;
    /**
     * @var string
     */
    private $cli_email;
    /**
     * @var string
     */
    private $cli_telefone;
    /**
     * @var string
     */
    private $cli_path_foto;
    /**
     * @var string
     */
    private $cli_data_cad;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->cli_id;
    }
    /**
     * @param string $cli_id
     * @return ClienteModel
     */
    public function setId(int $cli_id): ClienteModel
    {
        $this->cli_id = $cli_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->cli_nome;
    }
    /**
     * @param string $cli_nome
     * @return ClienteModel
     */
    public function setNome(string $cli_nome): ClienteModel
    {
        $this->cli_nome = $cli_nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->cli_email;
    }
    /**
     * @param string $cli_email
     * @return ClienteModel
     */
    public function setEmail(string $cli_email): ClienteModel
    {
        $this->cli_email = $cli_email;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone(): string
    {
        return $this->cli_telefone;
    }
    /**
     * @param string $cli_telefone
     * @return ClienteModel
     */
    public function setTelefone(string $cli_telefone): ClienteModel
    {
        $this->cli_telefone = $cli_telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPathImg(): string
    {
        return $this->cli_path_foto;
    }
    /**
     * @param string $cli_path_foto
     * @return ClienteModel
     */
    public function setPathImg(string $cli_path_foto): ClienteModel
    {
        $this->cli_path_foto = $cli_path_foto;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataCad(): string
    {
        return $this->cli_data_cad;
    }
    /**
     * @param string $cli_data_cad
     * @return ClienteModel
     */
    public function setDataCad(string $cli_data_cad): ClienteModel
    {
        $this->cli_data_cad = $cli_data_cad;
        return $this;
    }
}
