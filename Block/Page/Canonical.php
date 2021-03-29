<?php

namespace Hhennes\Cms\Block\Page;

use Magento\Framework\View\Element\AbstractBlock;

class Canonical extends AbstractBlock
{

    /** @var \Magento\Cms\Model\Page|null */
    protected $_page;

    /** @var \Hhennes\Cms\Helper\Data */
    protected $_helper;

    /**
     * Canonical constructor.
     * @param \Magento\Framework\View\Element\Context $context
     * @param array $data
     * @param \Magento\Cms\Model\Page $page
     * @param \Hhennes\Cms\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        array $data = [],
        \Magento\Cms\Model\Page $page,
        \Hhennes\Cms\Helper\Data $helper
    )
    {
        $this->_page = $page;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Cms\Model\Page
     */
    public function getPage()
    {
        return $this->_page;
    }

    /**
     * Get Canonical Page Url ( with or without trailing / )
     * @return string|bool
     */
    public function getCanonicalPageUrl()
    {
        if (null !== $this->getPage() && $this->_helper->isCanonicalUrlEnable()) {
            if ($this->isHomePage()) {
                if ($this->_helper->useTrailingSlash()) {
                    $url = $this->getUrl('');
                } else {
                    $url = rtrim($this->getUrl(''), '/');
                }
            } else {
                if ($this->_helper->useTrailingSlash()) {
                    $url = $this->getUrl($this->getPage()->getIdentifier());
                } else {
                    $url = $this->getUrl() . $this->getPage()->getIdentifier();
                }
            }
            return $url;
        } else {
            return false;
        }
    }

    /**
     * Display block
     * @return string
     */
    public function _toHtml()
    {
        if ($this->getCanonicalPageUrl()) {
            return "\n" . '<link rel="canonical" href="' . $this->getCanonicalPageUrl() . '"/>' . "\n";
        }

        return '';
    }

    /**
     * Check if current url is url for home page
     * @return bool
     */
    protected function isHomePage()
    {
        $currentUrl = $this->getUrl('', ['_current' => true]);
        $urlRewrite = $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);
        return $currentUrl == $urlRewrite;
    }
}
