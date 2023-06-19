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

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * GoSave\Banner\Block\Adminhtml\Edit
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
