<?php

namespace Hust\Service\Block\Adminhtml;

class Customer extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Hust_Service';
        $this->_controller = 'adminhtml_customer';
        parent::_construct();
        $this->buttonList->remove('add');

    }

    protected function _beforeToHtml()
    {
        return parent::_beforeToHtml(); // TODO: Change the autogenerated stub
    }
}