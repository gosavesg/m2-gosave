<?php

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

namespace Gosave\Banner\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * Gosave\Banner\Block\Adminhtml\Edit
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->canRender('save')) {
            $data = [
                'label' => __('Save'),
                'class' => 'save primary',
                'on_click' => '',
            ];
        }

        return $data;
    } //end getButtonData()
}//end class
