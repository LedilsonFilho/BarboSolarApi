<?php


namespace App\Helper;


use App\Entity\Instalacoes;
use App\Repository\UserRepository;

class InstalacaoFactory implements EntidadeFactoryInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->UserRepository = $userRepository;
    }
    public function criarEntidade(string $json)
    {
        $dadosEmJson = json_decode($json);
        $userId = $dadosEmJson->usuarioId;
        $usuario = $this->UserRepository->find($userId);


        $instalacao = new Instalacoes();
        $instalacao
            ->setUsuario($usuario)
            ->setEndereco($dadosEmJson->endereco)
            ->setGeolocalizacao($dadosEmJson->geolocalizacao)
            ->setConcessionaria($dadosEmJson->concessionaria)
            ->setCodclienteconc($dadosEmJson->codclienteconc)
            ->setCodinstalacaoconc($dadosEmJson->codinstalacaoconc)
            ->setPessfisica($dadosEmJson->pessfisica)
            ->setTitulareouser($dadosEmJson->titulareouser)
            ->setCpftitular($dadosEmJson->cpftitular)
            ->setTitular($dadosEmJson->titular);

        return $instalacao;
    }
}