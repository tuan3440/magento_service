<?php

namespace Hust\Service\Controller\Adminhtml\Service;


/**
 * Class MassDelete
 */
class MassDelete extends AbstractMassAction
{
    /**
     * @param $service
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    protected function itemAction($service)
    {
        try {
            $this->getRepository()->deleteById($service->getServiceId());
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage($e->getMessage());
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    protected function getErrorMessage()
    {
        return __('We can\'t delete item right now. Please review the log and try again.');
    }

    /**
     * @param int $collectionSize
     *
     * @return \Magento\Framework\Phrase
     */
    protected function getSuccessMessage($collectionSize = 0)
    {
        return $collectionSize
            ? __('A total of %1 record(s) have been deleted.', $collectionSize)
            : __('No records have been deleted.');
    }
}
