<?php

namespace Codealist\CmsContent\Helper;


use Magento\Cms\Model\BlockFactory;
use Magento\Cms\Model\BlockRepository;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\PageRepository;
use Magento\Framework\Exception\NoSuchEntityException;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Data constructor.
     * @param BlockFactory $blockFactory
     * @param BlockRepository $blockRepository
     * @param PageFactory $pageFactory
     * @param PageRepository $pageRepository
     */
    public function __construct(
        BlockFactory $blockFactory,
        BlockRepository $blockRepository,
        PageFactory $pageFactory,
        PageRepository $pageRepository
    )
    {
        $this->blockFactory      = $blockFactory;
        $this->blockRepository   = $blockRepository;
        $this->pageFactory       = $pageFactory;
        $this->pageRepository    = $pageRepository;
    }

    /**
     * Creates a CMS Block programmatically
     *
     * @param $identifier
     * @param $title
     * @param $content
     * @param null $stores
     * @param string $is_active
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function createBlock(
        $identifier,
        $title,
        $content,
        $stores = null,
        $is_active = '1'
    )
    {
        $stores = is_null($stores) ? ['0'] : $stores;
        try {
            $this->blockRepository->getById($identifier);
            // If code doesn't throw any exception, means the block already exists.
            // throw new AlreadyExistsException(__('"CMS Welcome block" already exists.'));
        }
        catch (NoSuchEntityException $notExist) {
            $data = [
                'title'      => $title,
                'identifier' => $identifier,
                'stores'     => $stores,
                'is_active'  => $is_active,
                'content'    => $content,
            ];

            $newBlock = $this->blockFactory->create();

            $newBlock->setData($data);

            $this->blockRepository->save($newBlock);

        }
    }

    /**
     * Creates a CMS Page programmatically
     *
     * @param $identifier
     * @param $title
     * @param $content
     * @param null $stores
     * @param string $is_active
     * @param null $metaTitle
     * @param null $metaDescription
     * @param null $pageLayout
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function createPage(
        $identifier,
        $title,
        $content,
        $stores = null,
        $is_active = '1',
        $metaTitle = null,
        $metaDescription = null,
        $pageLayout = null
    )
    {
        $stores = is_null($stores) ? ['0'] : $stores;

        try {
            $page = $this->pageRepository->getById($identifier);
        } catch (NoSuchEntityException $e) {
            $page = $this->pageFactory->create();
        }

        $page->setTitle($title);
        $page->setMetaTitle($metaTitle);
        $page->setMetaDescription($metaDescription);
        $page->setIdentifier($identifier);
        $page->setStoreId($stores);
        if ($pageLayout) $page->setPageLayout($pageLayout);
        $page->setIsActive($is_active);
        $page->setContent($content);
        $this->pageRepository->save($page);
    }
}