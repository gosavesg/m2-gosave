<?php

declare(strict_types=1);
/**
 * Gosave_Banner
 *
 * PHP Version 8.x
 *
 * @category  PHP
 * @package   Gosave\Banner
 * @author    https://Gosave.com.sg
 * @copyright 2023 Copyright Gosave Pvt Ltd, https://Gosave.com.sg/
 * @license   https://Gosave.com.sg/ Private
 */

namespace Gosave\Banner\Ui\Component\Listing\Column\Banner;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class Action
 * Gosave\Banner\Ui\Component\Listing\Column\Banner
 */
class Action extends Column
{
    /** Url path */
    const ROW_EDIT_URL = 'banner/managebanner/edit';
    const ROW_DELETE_URL = 'banner/managebanner/delete';

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * Action constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    } //end __construct()

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }
        foreach ($dataSource['data']['items'] as &$item) {
            $name = $this->getData('name');
            if (!isset($item['id'])) {
                continue;
            }
            $item[$name]['edit'] = [
                'href' => $this->urlBuilder->getUrl(
                    self::ROW_EDIT_URL,
                    ['id' => $item['id']]
                ),
                'label' => __('Edit')
            ];
            $item[$name]['delete'] = [
                'href' => $this->urlBuilder->getUrl(
                    self::ROW_DELETE_URL,
                    ['id' => $item['id']]
                ),
                'label' => __('Delete')
            ];
        }

        return $dataSource;
    } //end prepareDataSource()
}//end class
