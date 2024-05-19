<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProductService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getProducts(int $page, int $limit, string $sort, string $direction)
    {
        $queryBuilder = $this->em->getRepository(Product::class)->createQueryBuilder('p')
            ->orderBy('p.' . $sort, $direction)
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $paginator = new Paginator($queryBuilder);
        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $limit);

        return [
            'products' => $paginator,
            'totalItems' => $totalItems,
            'pagesCount' => $pagesCount,
            'currentPage' => $page,
            'sort' => $sort,
            'direction' => $direction,
        ];
    }

    public function getReport()
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        $report = [];

        foreach ($products as $product) {
            $code = $product->getCode();
            $type = $product->getType();
            $price = $product->getPrice();

            if (!isset($report[$code])) {
                $report[$code] = [
                    'total_quantity' => 0,
                    'total_price' => 0,
                    'types' => [],
                ];
            }

            $report[$code]['total_quantity']++;
            $report[$code]['total_price'] += $price;

            if (!isset($report[$code]['types'][$type])) {
                $report[$code]['types'][$type] = [
                    'quantity' => 0,
                    'price' => 0,
                ];
            }

            $report[$code]['types'][$type]['quantity']++;
            $report[$code]['types'][$type]['price'] += $price;
        }

        uasort($report, function ($a, $b) {
            return $b['total_quantity'] - $a['total_quantity'];
        });

        return $report;
    }
}
