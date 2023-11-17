<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Block\Index;

use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

class View extends \Magento\Framework\View\Element\Template
{
    protected \Rocha\Impactcampaigns\Model\ResourceModel\Campaign\CollectionFactory $campaignCollectionFactory;

    protected \Rocha\Impactcampaigns\Model\Campaign $campaign;

    protected \Magento\Framework\App\Request\Http $request;

    protected \Magento\Store\Model\StoreManagerInterface $storeManager;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface                               $storeManager,
        \Rocha\Impactcampaigns\Model\ResourceModel\Campaign\CollectionFactory    $campaignCollectionFactory,
        \Rocha\Impactcampaigns\Model\Campaign                                    $campaign,
        \Magento\Framework\App\Request\Http                                      $request,
        ProductCollectionFactory                                                 $productCollectionFactory,
        \Rocha\Impactcampaigns\Block\Index\ListProduct                             $blockList,
        \Magento\Framework\View\Element\Template\Context                         $context,
        array                                                                    $data = []
    )
    {
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->campaignCollectionFactory = $campaignCollectionFactory;
        $this->campaign = $campaign;
        $this->blockList = $blockList;
        $this->_productCollectionFactory = $productCollectionFactory;

        parent::__construct($context, $data);
    }
    public function getCampaign()
    {
        $campaignUri = explode('/', $this->request->getParam('identifier'));

        return $this->campaignCollectionFactory->create()
            ->addFieldToFilter('uri', end($campaignUri))
            ->addFieldToFilter('is_active', 1)
            ->getFirstItem();
    }

    public function getIsValidCampaing()
    {
        $storeId = $this->storeManager->getStore()->getId();
        $campaign = $this->getCampaign();
        if(count($campaign->getData())
            && ($storeId === $campaign->getStoreId()
                || $campaign->getStoreId() == 0
                || $campaign->getStoreId() == null )
        ){
            return true;
        }
        return false;
    }

    public function getProducts()
    {
        return  $this->campaign->getProducts($this->getCampaign());
    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('entity_id', ['in' => $this->getProducts()]);

        return $collection;
    }
}
