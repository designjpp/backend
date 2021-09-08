<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Product\Tests\Domain\Command\Bindings;

use Ergonode\Product\Domain\Command\Bindings\AddProductBindingCommand;
use PHPUnit\Framework\TestCase;
use Ergonode\SharedKernel\Domain\Aggregate\ProductId;
use Ergonode\SharedKernel\Domain\Aggregate\AttributeId;

class AddProductBindingCommandTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCommandCreation(): void
    {
        $productId = $this->createMock(ProductId::class);
        $bindingId = $this->createMock(AttributeId::class);

        $command = new AddProductBindingCommand($productId, $bindingId);
        self::assertSame($productId, $command->getId());
        self::assertSame($bindingId, $command->getBindingId());
    }
}
