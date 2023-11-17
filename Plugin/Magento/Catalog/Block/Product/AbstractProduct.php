<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Plugin\Magento\Catalog\Block\Product;

class AbstractProduct
{
    /**
     * ProductLabel data
     *
     * @var \Rocha\Impactcampaigns\Helper\ProductLabel
     */
    protected $productLabel;

    private $allowedBlocks = [
        'upsell_products_list',
        'related_products_list',
        'cart_cross_sell_products',
        'new_products_content_widget_gridt'
    ];

    public function __construct(
        \Rocha\Impactcampaigns\Helper\ProductLabel $productLabel,
        array $allowedBlocks = []
    )
    {
        $this->productLabel = $productLabel;
        $this->allowedBlocks = array_merge($this->allowedBlocks, array_values($allowedBlocks));
    }

    public function beforeGetImage(
        \Magento\Catalog\Block\Product\AbstractProduct $subject,
        $product,
        $imageId,
        $attributes = []
    ) {
        if (in_array($imageId, $this->getAllowedBlocks()) ) {
            $this->productLabel->isCampaign($product);
        }

        return [$product, $imageId, $attributes];
    }

    /**
     * @return array
     */
    public function getAllowedBlocks()
    {
        return $this->allowedBlocks;
    }
}

