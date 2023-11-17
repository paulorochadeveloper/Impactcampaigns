<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CampaignRepositoryInterface
{

    /**
     * Save Campaign
     * @param \Rocha\Impactcampaigns\Api\Data\CampaignInterface $campaign
     * @return \Rocha\Impactcampaigns\Api\Data\CampaignInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Rocha\Impactcampaigns\Api\Data\CampaignInterface $campaign
    );

    /**
     * Retrieve Campaign
     * @param string $campaignId
     * @return \Rocha\Impactcampaigns\Api\Data\CampaignInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($campaignId);

    /**
     * Retrieve Campaign matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Rocha\Impactcampaigns\Api\Data\CampaignSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Campaign
     * @param \Rocha\Impactcampaigns\Api\Data\CampaignInterface $campaign
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Rocha\Impactcampaigns\Api\Data\CampaignInterface $campaign
    );

    /**
     * Delete Campaign by ID
     * @param string $campaignId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($campaignId);
}

