<?php

namespace Hust\Service\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Schedule extends Container
{
    /**
     * Template file
     *
     * @var string
     */

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Hust_Service';
        $this->_controller = 'adminhtml_schedule';
        $this->_headerText = __('Booking Schedule');
        parent::_construct();
        $this->buttonList->remove('add');
        $this->addButton(
            'filter_form_submit',
            ['label' => __('Show Schedule'), 'onclick' => 'filterFormSubmit()', 'class' => 'primary']
        );
    }

    /**
     * Get filter URL
     *
     * @return string
     */
    public function getFilterUrl()
    {
        $this->getRequest()->setParam('filter', null);
        return $this->getUrl('*/*/index', ['_current' => true]);
    }
}

