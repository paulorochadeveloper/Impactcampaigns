<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Model\ResourceModel\Campaign;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'campaign_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Rocha\Impactcampaigns\Model\Campaign::class,
            \Rocha\Impactcampaigns\Model\ResourceModel\Campaign::class
        );
    }
}

