<?php

namespace Gosave\Homepage\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteria;

class CategoryProductsResolver implements ResolverInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly FilterBuilder $filterBuilder
    )
    {}

    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        // Implement the logic to fetch and return category products
        $categoryProducts = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 10.99,
                'category' => 'Category A'
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'price' => 19.99,
                'category' => 'Category B'
            ],
        ];

        return $categoryProducts;
    }

    public function __resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        $categoryId = 3;

        try {
            $searchCriteria = $this->buildSearchCriteria($categoryId);

            $products = $this->productRepository->getList($searchCriteria)->getItems();

            $result = [];
            foreach ($products as $product) {
                $result[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $product->getPrice(),
                    'category' => $product->getCategory()->getName()
                ];
            }

            return $result;
        } catch (LocalizedException $e) {
            // Handle exception
        }

        return null;
    }

    /**
     * @param $categoryId
     * @return SearchCriteria
     */
    private function buildSearchCriteria($categoryId): SearchCriteria
    {
        $filter = $this->filterBuilder
            ->setField('category_id')
            ->setConditionType('eq')
            ->setValue($categoryId)
            ->create();

        return $this->searchCriteriaBuilder
            ->addFilters([$filter])
            ->create();
    }
}
