<?php


namespace App\Helper;


use App\Entity\User;

class UseFacctory implements EntidadeFactoryInterface
{

    public function criarEntidade(string $json)
    {
        $dadosEmJson = json_decode($json);
        $user = new User();
        $user
            ->setUsername($dadosEmJson->username)
            ->setPassword($dadosEmJson->Password);

        return $user;
    }
}