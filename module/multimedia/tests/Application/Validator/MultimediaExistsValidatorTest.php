<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Multimedia\Tests\Application\Validator;

use Ergonode\Multimedia\Application\Validator\MultimediaExists;
use Ergonode\Multimedia\Application\Validator\MultimediaExistsValidator;
use Ergonode\Multimedia\Domain\Entity\Multimedia;
use Ergonode\SharedKernel\Domain\Aggregate\MultimediaId;
use Ergonode\Multimedia\Domain\Repository\MultimediaRepositoryInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class MultimediaExistsValidatorTest extends ConstraintValidatorTestCase
{
    private MultimediaRepositoryInterface $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(MultimediaRepositoryInterface::class);
        parent::setUp();
    }

    public function testCorrectEmptyValidation(): void
    {
        $this->validator->validate('', new MultimediaExists());

        $this->assertNoViolation();
    }

    public function testMultimediaExistsValidation(): void
    {
        $this->repository->method('load')->willReturn($this->createMock(Multimedia::class));
        $this->validator->validate(MultimediaId::generate(), new MultimediaExists());

        $this->assertNoViolation();
    }

    public function testMultimediaNotExistsValidation(): void
    {
        $this->repository->method('load')->willReturn(null);
        $constrain = new MultimediaExists();
        $value = MultimediaId::generate();

        $this->validator->validate($value, $constrain);

        $assertion = $this->buildViolation($constrain->message)->setParameter('{{ value }}', $value->getValue());
        $assertion->assertRaised();
    }

    protected function createValidator(): MultimediaExistsValidator
    {
        return new MultimediaExistsValidator($this->repository);
    }
}
