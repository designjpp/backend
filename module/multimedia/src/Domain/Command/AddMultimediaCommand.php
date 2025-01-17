<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Multimedia\Domain\Command;

use Ergonode\SharedKernel\Domain\Aggregate\MultimediaId;
use Symfony\Component\HttpFoundation\File\File;

class AddMultimediaCommand implements MultimediaCommandInterface
{
    private MultimediaId $id;

    private File $file;

    private ?string $name;

    /**
     * @throws \Exception
     */
    public function __construct(MultimediaId $id, File $file, ?string $name = null)
    {
        $this->id = $id;
        $this->file = $file;
        $this->name = $name;
    }

    public function getId(): MultimediaId
    {
        return $this->id;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
