<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Designer\Tests\Domain\Factory;

use Ergonode\Designer\Domain\Factory\TemplateFactory;
use Ergonode\Designer\Domain\ValueObject\Position;
use Ergonode\SharedKernel\Domain\Aggregate\AttributeId;
use Ergonode\SharedKernel\Domain\Aggregate\TemplateGroupId;
use Ergonode\SharedKernel\Domain\Aggregate\TemplateId;
use PHPUnit\Framework\TestCase;
use Ergonode\Designer\Domain\Entity\TemplateElementInterface;
use Ergonode\Designer\Domain\ValueObject\TemplateCode;

class TemplateFactoryTest extends TestCase
{
    private TemplateId $id;

    private TemplateCode $code;

    private TemplateGroupId $groupId;

    private string $name;

    private TemplateElementInterface $element;

    private AttributeId $defaultText;

    private AttributeId $defaultImage;

    protected function setUp(): void
    {
        $this->id = $this->createMock(TemplateId::class);
        $this->code = $this->createMock(TemplateCode::class);
        $this->defaultText = $this->createMock(AttributeId::class);
        $this->defaultImage = $this->createMock(AttributeId::class);
        $this->groupId = $this->createMock(TemplateGroupId::class);
        $this->name = 'Any template name';
        $this->element = $this->createMock(TemplateElementInterface::class);
        $this->element->method('getPosition')->willReturn(new Position(0, 0));
    }

    public function testFactoryCreateTemplate(): void
    {
        $factory = new TemplateFactory();
        $template = $factory->create(
            $this->id,
            $this->code,
            $this->groupId,
            $this->name,
            $this->defaultText,
            $this->defaultImage,
            [$this->element]
        );

        $this->assertEquals($this->id, $template->getId());
        $this->assertEquals($this->code, $template->getCode());
        $this->assertEquals($this->groupId, $template->getGroupId());
        $this->assertEquals($this->name, $template->getName());
        $this->assertCount(1, $template->getElements());
        $this->assertContainsOnlyInstancesOf(TemplateElementInterface::class, $template->getElements());
    }
}
