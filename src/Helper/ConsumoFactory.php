<?php


namespace App\Helper;


use App\Entity\Consumo;
use App\Repository\InstalacoesRepository;
use App\Repository\UserRepository;

class ConsumoFactory implements EntidadeFactoryInterface
{

    public function __construct(UserRepository $userRepository, InstalacoesRepository $instalacoesRepository)
    {
        $this->UserRepository = $userRepository;
        $this->InstalacoesRepository = $instalacoesRepository;
    }

    public function criarEntidade(string $json)
    {
        $dadosEmJson = json_decode($json);
        $userId = $dadosEmJson->usuarioId;
        $usuario = $this->UserRepository->find($userId);
        $instalacaoId = $dadosEmJson->instalacaoId;
        $instalacao = $this->InstalacoesRepository->find($instalacaoId);
        $date = \DateTime::createFromFormat('Y-m-d', $dadosEmJson->dataReferencia);

        $consumo = new Consumo();
        $consumo
            ->setUsuarioId($usuario)
            ->setInstalacoesId($instalacao)
            ->setCredito($dadosEmJson->credito)
            ->setConsumo($dadosEmJson->consumo)
            ->setDatareferencia($date);
        return $consumo;
    }
}