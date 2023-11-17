<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Controller\Adminhtml\Campaign;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->_jsHelper = $jsHelper;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('campaign_id');

            $model = $this->_objectManager->create(\Rocha\Impactcampaigns\Model\Campaign::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Campaign no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->saveProducts($model, $data);

                $this->messageManager->addSuccessMessage(__('You saved the Campaign.'));
                $this->dataPersistor->clear('rocha_impactcampaigns_campaign');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['campaign_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Campaign.'));
            }

            $this->dataPersistor->set('rocha_impactcampaigns_campaign', $data);
            return $resultRedirect->setPath('*/*/edit', ['campaign_id' => $this->getRequest()->getParam('campaign_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
    public function saveProducts($model, $post)
    {

        // Attach the attachments to contact
        if (isset($post['products'])) {
            $productIds = $this->_jsHelper->decodeGridSerializedInput($post['products']);
            try {
                $oldProducts = (array) $model->getProducts($model);
                $newProducts = (array) $productIds;

                $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
                $connection = $this->_resources->getConnection();

                $table = $this->_resources->getTableName(\Rocha\Impactcampaigns\Model\ResourceModel\Campaign::CAMPAING_PRODUCT);
                $insert = array_diff($newProducts, $oldProducts);
                $delete = array_diff($oldProducts, $newProducts);

                if ($delete) {
                    $where = ['campaign_id = ?' => (int)$model->getId(), 'product_id IN (?)' => $delete];
                    $connection->delete($table, $where);
                }

                if ($insert) {
                    $data = [];
                    foreach ($insert as $product_id) {
                        $data[] = ['campaign_id' => (int)$model->getId(), 'product_id' => (int)$product_id];
                    }
                    $connection->insertMultiple($table, $data);
                }
            } catch (Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the contact.'));
            }
        }

    }
}

