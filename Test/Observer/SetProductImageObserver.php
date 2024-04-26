<?php

namespace Sachin\Test\Observer;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SetProductImageObserver implements ObserverInterface
{
    const CUSTOM_IMAGE_URL = 'https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg';

    public function execute(Observer $observer)
    {
        /** @var Product $product */
        $product = $observer->getEvent()->getProduct();
        $productType = $product->getProductType();

        if ($productType === 'custom') {
            $product->setImage(self::CUSTOM_IMAGE_URL);
            $product->setSmallImage(self::CUSTOM_IMAGE_URL);
            $product->setThumbnail(self::CUSTOM_IMAGE_URL);
            $product->save();
        }
    }
}