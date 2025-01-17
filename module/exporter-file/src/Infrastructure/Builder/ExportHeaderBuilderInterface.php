<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\ExporterFile\Infrastructure\Builder;

interface ExportHeaderBuilderInterface
{
    public function header(): array;

    public function fileName(): string;
}
