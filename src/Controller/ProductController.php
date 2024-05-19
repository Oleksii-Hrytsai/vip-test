<?php

namespace App\Controller;

use App\Command\CreateProductCommand;
use App\Handler\CreateProductHandler;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $productService;
    private $createProductHandler;

    public function __construct(ProductService $productService, CreateProductHandler $createProductHandler)
    {
        $this->productService = $productService;
        $this->createProductHandler = $createProductHandler;
    }

    #[Route('/products', name: 'product_list')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 20;
        $sort = $request->query->get('sort', 'createdAt');
        $direction = $request->query->get('direction', 'desc');

        $data = $this->productService->getProducts($page, $limit, $sort, $direction);

        return $this->render('product/index.html.twig', $data);
    }

    #[Route('/products/report', name: 'product_report')]
    public function report(): Response
    {
        $report = $this->productService->getReport();

        return $this->render('product/report.html.twig', [
            'report' => $report,
        ]);
    }

    #[Route('/products/create', name: 'product_create')]
    public function create(Request $request): Response
    {
        $command = new CreateProductCommand(
            $request->request->get('code'),
            $request->request->get('name'),
            $request->request->get('type'),
            $request->request->get('price')
        );

        $this->createProductHandler->handle($command);

        return $this->redirectToRoute('product_list');
    }
}
