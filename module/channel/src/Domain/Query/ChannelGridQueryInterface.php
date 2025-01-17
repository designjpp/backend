<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Channel\Domain\Query;

use Ergonode\Core\Domain\ValueObject\Language;
use Doctrine\DBAL\Query\QueryBuilder;

interface ChannelGridQueryInterface
{
    public function getGridQuery(Language $language): QueryBuilder;
}
