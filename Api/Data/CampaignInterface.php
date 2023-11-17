<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Api\Data;

interface CampaignInterface
{

    const CAMPAING_ID = 'campaign_id';
    const IS_ACTIVE = 'is_active';
    const TITLE = 'title';
    const URI = 'uri';
    const DESCRIPTION = 'Description';
    const LABEL_COLOR = 'label_color';
    const TEXT_COLOR = 'text_color';

    const STORE_ID = 'store_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get campaign_id
     * @return string|null
     */
    public function getCampaignId();

    /**
     * Set campaign_id
     * @param string $campaignId
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setCampaignId($campaignId);

    /**
     * Get is_active
     * @return string|null
     */
    public function getIsActive();

    /**
     * Set is_active
     * @param string $isActive
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setIsActive($isActive);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setTitle($title);

    /**
     * Get Description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set Description
     * @param string $description
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setDescription($description);

    /**
     * Get uri
     * @return string|null
     */
    public function getUri();

    /**
     * Set uri
     * @param string $uri
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setUri($uri);

    /**
     * Get label_color
     * @return string|null
     */
    public function getLabelColor();

    /**
     * Set label_color
     * @param string $labelColor
     * @return \Rocha\Impactcampaigns\Campaing\Api\Data\CampaingInterface
     */
    public function setLabelColor($labelColor);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get text_color
     * @return string|null
     */
    public function getTextColor();

    /**
     * Set text_color
     * @param string $textColor
     * @return \Rocha\Impactcampaigns\Campaing\Api\Data\CampaingInterface
     */
    public function setTextColor($textColor);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \Rocha\Impactcampaigns\Campaing\Api\Data\CampaingInterface
     */
    public function setStoreId($storeId);

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Rocha\Impactcampaigns\Campaign\Api\Data\CampaignInterface
     */
    public function setUpdatedAt($updatedAt);
}

