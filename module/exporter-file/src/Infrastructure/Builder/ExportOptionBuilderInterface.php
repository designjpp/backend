<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterFile\Infrastructure\Builder;

use Ergonode\ExporterFile\Infrastructure\DataStructure\ExportLineData;
use Ergonode\Attribute\Domain\Entity\AbstractOption;
use Ergonode\Core\Domain\ValueObject\Language;

interface ExportOptionBuilderInterface
{
    public function header(): array;

    public function build(AbstractOption $option, ExportLineData $line, Language $language): void;
}
