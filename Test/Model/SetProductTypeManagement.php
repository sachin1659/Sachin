<?php
namespace Sachin\Test\Model;

use Sachin\Test\Api\SetProductTypeManagementInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class SetProductTypeManagement implements SetProductTypeManagementInterface
{
    protected $productRepository;
    protected $request;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Webapi\Rest\Request $request,
    ) {
        $this->productRepository = $productRepository;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function setProductType()
    {
        try {
            $data = $this->request->getBodyParams();
            $product = $this->productRepository->get($data['sku']);
            $product->setCustomAttribute('product_type', 'CustomValue'); // Assuming 'product_type' is the custom attribute code
            $this->productRepository->save($product);
            return true;
        } catch (NoSuchEntityException $e) {
            return false; // Product not found
        } catch (\Exception $e) {
            return false; // Error occurred
        }
    }
}
