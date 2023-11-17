<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rocha\Impactcampaigns\Helper;

use  Magento\Catalog\Model\Product as ModelProduct;
use  Rocha\Impactcampaigns\Model\ResourceModel\Campaign\CollectionFactory  as CampaignCollectionFactory;

class ProductLabel extends \Magento\Framework\Url\Helper\Data
{

    protected TimezoneInterface $localeDate;

    protected \Magento\Store\Model\StoreManagerInterface $storeManager;

    protected CampaignCollectionFactory $campaignCollectionFactory;

    protected ModelProduct $product;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CampaignCollectionFactory   $campaignCollectionFactory,
        \Rocha\Impactcampaigns\Model\Campaign $campaign,
        ModelProduct $product,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->storeManager = $storeManager;
        $this->campaign = $campaign;
        $this->campaignCollectionFactory = $campaignCollectionFactory;
        $this->product = $product;

        parent::__construct($context);
    }

    public function isCampaign(ModelProduct $product)
    {
        $this->getLabel($product);
    }

    public function isCampaignByProductId($product_id)
    {
        $product = $this->product->loadByAttribute('entity_id',$product_id );
        $this->getLabel($product);
    }

    public function getLabel($product){
        $storeId = $this->storeManager->getStore()->getId();
        $campaign_ids = $this->campaign->getCampaigns($product);
        $campaigns = $this->campaignCollectionFactory->create()
            ->addFieldToFilter('campaign_id', array('in' => $campaign_ids) )
            ->addFieldToFilter('is_active', 1)
            ->getItems();

        $incrementTop = 0;
        $increment = 0;
        foreach ($campaigns as $campaign){
            if(($storeId === $campaign->getStoreId()
                || $campaign->getStoreId() == 0
                || $campaign->getStoreId() == null )
            ){
                $increment += $incrementTop;
                ?>
                <div class="campaign-label" style="margin-top:<?=$increment; ?>px; background-color:<?=$campaign->getLabelColor(); ?>; color:<?=$campaign->getTextColor(); ?>">
                    <?=$campaign->getTitle(); ?>
                </div>
                <?php
                $incrementTop = 40;
            }
        }
    }
}
