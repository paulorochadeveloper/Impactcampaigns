<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Api\Data;

interface CampaignSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Campaign list.
     * @return \Rocha\Impactcampaigns\Api\Data\CampaignInterface[]
     */
    public function getItems();

    /**
     * Set is_active list.
     * @param \Rocha\Impactcampaigns\Api\Data\CampaignInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

