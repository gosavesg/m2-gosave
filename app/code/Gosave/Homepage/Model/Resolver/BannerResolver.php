<?php

namespace Gosave\Homepage\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Gosave\Banner\Model\BannerRepository;

class BannerResolver implements ResolverInterface
{
    /**
     * @var BannerRepository
     */
    private $bannerRepository;

    /**
     * BannerResolver constructor.
     *
     * @param BannerRepository $bannerRepository
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|null
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if ($field->getName() === 'getBanners') {
            return $this->bannerRepository->getBanners();
        }

        return null; // Handle other custom fields if any
    }
}
