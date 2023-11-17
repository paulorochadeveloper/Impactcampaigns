<?php
/**
 * Copyright © Paulo Rocha All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Rocha\Impactcampaigns\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Campaign extends AbstractDb
{
    const CAMPAING_PRODUCT = 'rocha_impactcampaigns_campaign_products';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('rocha_impactcampaigns_campaign', 'campaign_id');
    }
}

