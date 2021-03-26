<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\Integration\Api;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Integration\Api\Data\UserTokenParameters;
use Magento\Integration\Api\Exception\UserTokenException;

/**
 * Issues tokens used to authenticate users.
 */
interface UserTokenIssuerInterface
{
    /**
     * Create token for a user.
     *
     * @param UserContextInterface $userContext
     * @param UserTokenParameters $params
     * @return string
     * @throws UserTokenException
     */
    public function create(UserContextInterface $userContext, UserTokenParameters $params): string;
}
