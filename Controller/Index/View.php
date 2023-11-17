<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Rocha\Impactcampaigns\Model\ResourceModel\Campaign\CollectionFactory;

class View implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * @var Http
     */
    protected Http $request;

    protected CollectionFactory $campaignCollectionFactory;
    protected \Magento\Store\Model\StoreManagerInterface $storeManager;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     * @param Http $request
     * @param CollectionFactory $campaignCollectionFactory
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        PageFactory $resultPageFactory,
        Http $request,
        CollectionFactory $campaignCollectionFactory,
    )
    {
        $this->storeManager = $storeManager;
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
        $this->campaignCollectionFactory = $campaignCollectionFactory;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $campaignUri = explode('/', $this->request->getParam('identifier') );
        $storeId = $this->storeManager->getStore()->getId();

        $campaign = $this->campaignCollectionFactory->create()
            ->addFieldToFilter('uri', end($campaignUri))
            ->addFieldToFilter('is_active', 1)
            ->getFirstItem();

        if(count($campaign->getData())
            && ($storeId === $campaign->getStoreId()
                || $campaign->getStoreId() == 0
                || $campaign->getStoreId() == NULL )
        ){
            $pageFactory = $this->resultPageFactory->create();

            $pageFactory->getConfig()->getTitle()->set(
                __($campaign->getTitle())
            );
        }else{
            $pageFactory = $this->resultPageFactory->create();

            $pageFactory->getConfig()->getTitle()->set(
                __('Campaign not found')
            );
        }

        return $pageFactory;
    }
}

