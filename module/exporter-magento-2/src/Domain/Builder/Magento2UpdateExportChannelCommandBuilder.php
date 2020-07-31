<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\ExporterMagento2\Domain\Builder;

use Ergonode\EventSourcing\Infrastructure\DomainCommandInterface;
use Ergonode\ExporterMagento2\Application\Form\Model\ExporterMagento2CsvConfigurationModel;
use Symfony\Component\Form\FormInterface;
use Ergonode\Channel\Application\Provider\UpdateChannelCommandBuilderInterface;
use Ergonode\ExporterMagento2\Domain\Entity\Magento2CsvChannel;
use Ergonode\SharedKernel\Domain\Aggregate\ChannelId;
use Ergonode\ExporterMagento2\Domain\Command\UpdateMagento2ExportChannelCommand;

/**
 */
class Magento2UpdateExportChannelCommandBuilder implements UpdateChannelCommandBuilderInterface
{
    /**
     * @param string $type
     *
     * @return bool
     */
    public function supported(string $type): bool
    {
        return Magento2CsvChannel::TYPE === $type;
    }

    /**
     * @param ChannelId     $channelId
     * @param FormInterface $form
     *
     * @return DomainCommandInterface
     */
    public function build(ChannelId $channelId, FormInterface $form): DomainCommandInterface
    {
        /** @var ExporterMagento2CsvConfigurationModel $data */
        $data = $form->getData();

        $name = $data->name;
        $filename = $data->filename;
        $language = $data->defaultLanguage;

        return new UpdateMagento2ExportChannelCommand(
            $channelId,
            $name,
            $filename,
            $language
        );
    }
}