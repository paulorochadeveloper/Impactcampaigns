<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Model;

use Magento\Framework\Model\AbstractModel;
use Rocha\Impactcampaigns\Api\Data\CampaignInterface;
use Magento\Catalog\Model\Product as ModelProduct;

class Campaign extends AbstractModel implements CampaignInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Rocha\Impactcampaigns\Model\ResourceModel\Campaign::class);
    }

    /**
     * @inheritDoc
     */
    public function getCampaignId()
    {
        return $this->getData(self::CAMPAING_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCampaignId($campaignId)
    {
        return $this->setData(self::CAMPAING_ID, $campaignId);
    }

    /**
     * @inheritDoc
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->getData(self::URI);
    }

    /**
     * @inheritDoc
     */
    public function setUri($uri)
    {
        return $this->setData(self::URI, $uri);
    }

    /**
     * @inheritDoc
     */
    public function getLabelColor()
    {
        return $this->getData(self::LABEL_COLOR);
    }

    /**
     * @inheritDoc
     */
    public function setLabelColor($labelColor)
    {
        return $this->setData(self::LABEL_COLOR, $labelColor);
    }


    /**
     * @inheritDoc
     */
    public function getTextColor()
    {
        return $this->getData(self::TEXT_COLOR);
    }

    /**
     * @inheritDoc
     */
    public function setTextColor($textColor)
    {
        return $this->setData(self::TEXT_COLOR, $textColor);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @inheritDoc
     */
    public function getProducts(\Rocha\Impactcampaigns\Model\Campaign $object)
    {
        $relationshipTable = $this->getResource()->getTable(\Rocha\Impactcampaigns\Model\ResourceModel\Campaign::CAMPAING_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $relationshipTable,
            ['product_id']
        )
            ->where(
                'campaign_id = ?',
                (int)$object->getId()
            );
        return $this->getResource()->getConnection()->fetchCol($select);
    }

    /**
     * @inheritDoc
     */
    public function getCampaigns(ModelProduct $object)
    {
        $relationshipTable = $this->getResource()->getTable(\Rocha\Impactcampaigns\Model\ResourceModel\Campaign::CAMPAING_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $relationshipTable,
            ['campaign_id']
        )
            ->where(
                'product_id = ?',
                (int)$object->getId()
            );

        return $this->getResource()->getConnection()->fetchCol($select);
    }
}

