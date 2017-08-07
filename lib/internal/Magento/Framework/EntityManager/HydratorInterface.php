<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\EntityManager;

/**
 * Interface HydratorInterface
 * @since 2.1.0
 */
interface HydratorInterface
{
    /**
     * Extract data from object
     *
     * @param object $entity
     * @return array
     * @since 2.1.0
     */
    public function extract($entity);

    /**
     * Populate entity with data
     *
     * @param object $entity
     * @param array $data
     * @return object
     * @since 2.1.0
     */
    public function hydrate($entity, array $data);
}
