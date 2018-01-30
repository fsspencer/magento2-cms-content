<?php

namespace Codealist\CmsContent\Block;


class Template extends \Magento\Framework\View\Element\Template
{

    /**
     * Template constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * This is a sample method
     *
     * @return \Magento\Framework\Phrase|string|void
     */
    public function sayHello()
    {
        return __('Hello World');
    }
}