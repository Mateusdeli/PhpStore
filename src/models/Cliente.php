<?php

namespace App\WebStore\Models;

class Cliente
{
    private string $email;
    private string $password;
    private string $confirmPassword;
    private string $nome_completo;
    private string $endereco;
    private string $cidade;
    private string $telefone;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function getNomeCompleto(): string
    {
        return $this->nome_completo;
    }

    public function getEndereco(): string
    {
        return $this->endereco;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setConfirmPassword(string $confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;
    }

    public function setNomeCompleto(string $nome_completo)
    {
        $this->nome_completo = $nome_completo;
    }

    public function setEndereco(string $endereco)
    {
        $this->endereco = $endereco;
    }

    public function setCidade(string $cidade)
    {
        $this->cidade = $cidade;
    }

    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
    }


}