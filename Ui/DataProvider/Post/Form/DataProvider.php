<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\Blog\Ui\DataProvider\Post\Form;

use CommerceLeague\Blog\Api\Data\PostInterface;
use CommerceLeague\Blog\Model\ResourceModel\Post\CollectionFactory;
use CommerceLeague\Blog\Model\ResourceModel\Post\Collection;
use CommerceLeague\Blog\Service\PostRegistry;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var PostRegistry
     */
    private $postRegistry;

    /**
     * @var array
     */
    private $loadedData = [];

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param PostRegistry $postRegistry
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        PostRegistry $postRegistry,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collectionFactory->create();
        $this->postRegistry = $postRegistry;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = ($currentPost = $this->postRegistry->get()) ? [$currentPost] : $this->collection->getItems();

        /** @var PostInterface $item */
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
