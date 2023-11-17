<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Rocha\Impactcampaigns\Api\CampaignRepositoryInterface;
use Rocha\Impactcampaigns\Api\Data\CampaignInterface;
use Rocha\Impactcampaigns\Api\Data\CampaignInterfaceFactory;
use Rocha\Impactcampaigns\Api\Data\CampaignSearchResultsInterfaceFactory;
use Rocha\Impactcampaigns\Model\ResourceModel\Campaign as ResourceCampaign;
use Rocha\Impactcampaigns\Model\ResourceModel\Campaign\CollectionFactory as CampaignCollectionFactory;

class CampaignRepository implements CampaignRepositoryInterface
{

    /**
     * @var ResourceCampaign
     */
    protected $resource;

    /**
     * @var Campaign
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CampaignInterfaceFactory
     */
    protected $campaignFactory;

    /**
     * @var CampaignCollectionFactory
     */
    protected $campaignCollectionFactory;


    /**
     * @param ResourceCampaign $resource
     * @param CampaignInterfaceFactory $campaignFactory
     * @param CampaignCollectionFactory $campaignCollectionFactory
     * @param CampaignSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCampaign $resource,
        CampaignInterfaceFactory $campaignFactory,
        CampaignCollectionFactory $campaignCollectionFactory,
        CampaignSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->campaignFactory = $campaignFactory;
        $this->campaignCollectionFactory = $campaignCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CampaignInterface $campaign)
    {
        try {
            $this->resource->save($campaign);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the campaign: %1',
                $exception->getMessage()
            ));
        }
        return $campaign;
    }

    /**
     * @inheritDoc
     */
    public function get($campaignId)
    {
        $campaign = $this->campaignFactory->create();
        $this->resource->load($campaign, $campaignId);
        if (!$campaign->getId()) {
            throw new NoSuchEntityException(__('Campaign with id "%1" does not exist.', $campaignId));
        }
        return $campaign;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->campaignCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CampaignInterface $campaign)
    {
        try {
            $campaignModel = $this->campaignFactory->create();
            $this->resource->load($campaignModel, $campaign->getCampaignId());
            $this->resource->delete($campaignModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Campaign: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($campaignId)
    {
        return $this->delete($this->get($campaignId));
    }
}

