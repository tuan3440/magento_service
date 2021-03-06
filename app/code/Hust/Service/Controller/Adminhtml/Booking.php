<?php

namespace Hust\Service\Controller\Adminhtml;

use Hust\Service\Model\BookingFactory;
use Hust\Service\Model\Repository\BookingRepository;
use Hust\Service\Model\ServiceRegistry;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\LayoutFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\Auth\Session;

abstract class Booking extends Action
{
    const ADMIN_RESOURCE = 'Hust_Service::hust_booking';

    protected $resultPageFactory;
    private $bookingFactory;
    private $bookingRepository;
    private $serviceRegistry;
    protected $layoutFactory;
    protected $session;

    public function __construct(
        Context $context,
        Session       $session,
        PageFactory $resultPageFactory,
        BookingFactory $bookingFactory,
        BookingRepository $bookingRepository,
        ServiceRegistry $serviceRegistry,
        LayoutFactory $layoutFactory
    )
    {
        $this->session = $session;
        $this->resultPageFactory = $resultPageFactory;
        $this->bookingFactory = $bookingFactory;
        $this->bookingRepository = $bookingRepository;
        $this->serviceRegistry = $serviceRegistry;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }

    protected function getBookingFactory()
    {
        return $this->bookingFactory;
    }

    protected function getBookingRepository()
    {
        return $this->bookingRepository;
    }

    protected function getServiceRegistry()
    {
        return $this->serviceRegistry;
    }

    protected function checkBooking($bookingCurrentId)
    {
        $locatorId = $this->getCurrentUser()->getData('locator_id');
        $bookingExist = $this->getBookingFactory()->create()->getCollection()
            ->addFieldToFilter("booking_id", $bookingCurrentId)
            ->addFieldToFilter("locator_id", $locatorId);
        if ($bookingExist->getSize() > 0) return true;
        return false;
    }
    public function getCurrentUser()
    {
        return $this->session->getUser();
    }

}
