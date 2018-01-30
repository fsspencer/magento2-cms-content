<?php

namespace Codealist\CmsContent\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Codealist\CmsContent\Helper\Data as CmsHelperData;


class InstallData implements InstallDataInterface
{
    public function __construct(
        CmsHelperData $cmsContentHelper
    )
    {
        $this->cmsContentHelper = $cmsContentHelper;
    }

    /**
     * Function install
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->cmsContentHelper->createBlock("my-custom-block", "My Custom Block", '
<div class="col-md-3">
    <h1>Nothing to be displayed</h1>
    <p>lorem ipsum</p>
</div>
        ',
        ['0'],
            true);


        $this->cmsContentHelper->createPage(
            'my-custom-page',
            'My Custom Page',
            '
<div class="col-md-3">
    <h1>Nothing to be displayed</h1>
    <p>lorem ipsum</p>
</div>',
            [ '1' ]
        );
    }
}