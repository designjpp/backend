<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Condition\Persistence\Dbal\Projector;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Ergonode\Condition\Domain\Event\ConditionSetDescriptionChangedEvent;
use Ergonode\Core\Domain\Entity\AbstractId;
use Ergonode\EventSourcing\Infrastructure\DomainEventInterface;
use Ergonode\EventSourcing\Infrastructure\Exception\UnsupportedEventException;
use Ergonode\EventSourcing\Infrastructure\Projector\DomainEventProjectorInterface;
use JMS\Serializer\SerializerInterface;

/**
 */
class ConditionSetDescriptionChangedEventProjector implements DomainEventProjectorInterface
{
    private const TABLE = 'condition_set';

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param Connection          $connection
     * @param SerializerInterface $serializer
     */
    public function __construct(Connection $connection, SerializerInterface $serializer)
    {
        $this->connection = $connection;
        $this->serializer = $serializer;
    }

    /**
     * @param DomainEventInterface $event
     *
     * @return bool
     */
    public function support(DomainEventInterface $event): bool
    {
        return $event instanceof ConditionSetDescriptionChangedEvent;
    }

    /**
     * @param AbstractId           $aggregateId
     * @param DomainEventInterface $event
     *
     * @throws UnsupportedEventException
     * @throws DBALException
     */
    public function projection(AbstractId $aggregateId, DomainEventInterface $event): void
    {
        if (!$event instanceof ConditionSetDescriptionChangedEvent) {
            throw new UnsupportedEventException($event, ConditionSetDescriptionChangedEvent::class);
        }

        $this->connection->update(
            self::TABLE,
            [
                'description' => $this->serializer->serialize($event->getTo(), 'json'),
            ],
            [
                'id' => $aggregateId->getValue(),
            ]
        );
    }
}
