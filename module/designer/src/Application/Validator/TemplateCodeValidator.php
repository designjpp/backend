<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Designer\Application\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Ergonode\Attribute\Domain\ValueObject\AttributeCode as ValueObject;

class TemplateCodeValidator extends ConstraintValidator
{
    /**
     * @param mixed                    $value
     * @param TemplateCode|Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof TemplateCode) {
            throw new UnexpectedTypeException($constraint, TemplateCode::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = trim((string) $value);
        if (mb_strlen($value) > $constraint->max) {
            $this->context->buildViolation($constraint->maxMessage)
                ->setParameter('{{ limit }}', (string) $constraint->max)
                ->addViolation();

            return;
        }

        if (mb_strlen($value) < $constraint->min) {
            $this->context->buildViolation($constraint->minMessage)
                ->setParameter('{{ limit }}', (string) $constraint->min)
                ->addViolation();

            return;
        }

        if (!ValueObject::isValid($value)) {
            $this->context->buildViolation($constraint->validMessage)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
