<?php

namespace App\Controller;

use App\Entity\Instalacoes;
use App\Helper\ExtratorDadosRequest;
use App\Helper\InstalacaoFactory;
use App\Repository\InstalacoesRepository;
use Doctrine\ORM\EntityManagerInterface;
;

class InstalacaoController extends BaseController
{
    public function __construct(
        EntityManagerInterface $entityManager,
        InstalacoesRepository $repository,
        InstalacaoFactory $factory,
        ExtratorDadosRequest $extratorDadosRequest
    ) {
        parent::__construct($entityManager, $repository, $factory, $extratorDadosRequest);
    }

    function atualizaEntidadeExistente(int $id, $entidade)
    {
        /** @var Instalacoes $entidadeExistente */
        $entidadeExistente = $this->repository->find($id);
        if (is_null($entidadeExistente)) {
            throw new \InvalidArgumentException();
        }

        $entidadeExistente
            ->setUsuario($entidade->getUsuario())
            ->setEndereco($entidade->getEndereco())
            ->setGeolocalizacao($entidade->getGeolocalizacao())
            ->setConcessionaria($entidade->getConcessionaria())
            ->setCodclienteconc($entidade->getCodclienteconc())
            ->setCodinstalacaoconc($entidade->getCodinstalacaoconc())
            ->setPessfisica($entidade->getPessfisica())
            ->setTitulareouser($entidade->getTitulareouser())
            ->setCpftitular($entidade->getCpftitular())
            ->setTitular($entidade->getTitular());

        return $entidadeExistente;
    }
}
