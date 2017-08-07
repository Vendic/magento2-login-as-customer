<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Model\Product\Website;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\Website\Link as ProductWebsiteLink;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class SaveHandler
 * @package Magento\Catalog\Model\Product\Website
 * @since 2.2.0
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Website\Link
     * @since 2.2.0
     */
    private $productWebsiteLink;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     * @since 2.2.0
     */
    private $storeManager;

    /**
     * SaveHandler constructor.
     * @param ProductWebsiteLink $productWebsiteLink
     * @param StoreManagerInterface $storeManager
     * @since 2.2.0
     */
    public function __construct(
        ProductWebsiteLink $productWebsiteLink,
        StoreManagerInterface $storeManager
    ) {
        $this->productWebsiteLink = $productWebsiteLink;
        $this->storeManager = $storeManager;
    }

    /**
     * Get website ids from extension attributes and persist them
     * @param ProductInterface $product
     * @param array $arguments
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return ProductInterface
     * @since 2.2.0
     */
    public function execute($product, $arguments = [])
    {
        if ($this->storeManager->isSingleStoreMode()) {
            $defaultWebsiteId = $this->storeManager->getDefaultStoreView()->getWebsiteId();
            $websiteIds = [$defaultWebsiteId];
        } else {
            $extensionAttributes = $product->getExtensionAttributes();
            $websiteIds = $extensionAttributes->getWebsiteIds();
        }

        if ($websiteIds !== null) {
            $this->productWebsiteLink->saveWebsiteIds($product, $websiteIds);
        }

        return $product;
    }
}
