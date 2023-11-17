<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Plugin\Magento\Framework\View\Element;

class AbstractBlock
{
    /**
     * ProductLabel data
     *
     * @var \Rocha\Impactcampaigns\Helper\ProductLabel
     */
    protected $productLabel;

    public function __construct(\Rocha\Impactcampaigns\Helper\ProductLabel $productLabel)
    {
        $this->productLabel = $productLabel;
    }

    public function beforeToHtml(
        \Magento\Framework\View\Element\AbstractBlock $subject
    ) {

        if($subject->getDataByKey('class') == 'product-image-photo' && $subject->getDataByKey('product_id') ){
            $this->productLabel->isCampaignByProductId($subject->getDataByKey('product_id'));
        }
        return [];
    }

}

