<?php

/**
 * GoSave_Banner
 * 
 * PHP Version 8.x
 *
 * @category  PHP
 * @package   GoSave\Banner
 * @author    https://gosave.com.sg
 * @copyright 2023 Copyright GoSave Pvt Ltd, https://gosave.com.sg/
 * @license   https://gosave.com.sg/ Private
 */

namespace GoSave\Banner\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\Request\Http as Request;

/**
 * Class GenericButton
 * GoSave\Banner\Block\Adminhtml\Edit
 */
class GenericButton
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Request
     */
    private $request;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Request $request
     */
    public function __construct(
        Context $context,
        Request $request
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->request = $request;
    } //end __construct()

    /**
     * Return the request Id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->request->getParam('id', 0);
    } //end getId()

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    } //end getUrl()

    /**
     * Check where button can be rendered
     *
     * @param string $name Name
     * @return string
     */
    public function canRender($name)
    {
        return $name;
    } //end canRender()
}//end class
