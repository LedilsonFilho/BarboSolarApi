<?php

namespace App\Controller;

use App\Helper\ConsumoFactory;
use App\Helper\ExtratorDadosRequest;
use App\Helper\InstalacaoFactory;
use App\Helper\ResponseFactory;
use App\Repository\ConsumoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsumoController extends BaseController
{
    /**
     * @var ConsumoRepository
     */
    protected $consumorepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ConsumoRepository $consumorepository,
        ConsumoFactory $factory,
        ExtratorDadosRequest $extratorDadosRequest
    ) {
        parent::__construct($entityManager, $consumorepository, $factory, $extratorDadosRequest);
        $this->consumorepository = $consumorepository;
    }

    function atualizaEntidadeExistente(int $id, $entidade)
    {
        // TODO: Implement atualizaEntidadeExistente() method.
    }

    public function buscarPorIdAnoCredito($id_instalacao, $ano, $credito): Response
    {
        $entidade = $this->consumorepository->findOneByYear($id_instalacao, $ano, $credito);
        $statusResposta = is_null($entidade)
            ? Response::HTTP_NO_CONTENT
            : Response::HTTP_OK;
        $fabricaResposta = new ResponseFactory(
            true,
            $entidade,
            $statusResposta
        );

        return $fabricaResposta->getConsumoResponse();

    }
}
