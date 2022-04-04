<?php

namespace Hhennes\Cms\Block\Page;

use Hhennes\Cms\Helper\Data;
use Magento\Cms\Model\Page;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;

class Canonical extends AbstractBlock
{

    /** @var Page|null */
    protected $_page;

    /** @var Data */
    protected $_helper;

    /**
     * Canonical constructor.
     * @param Context $context
     * @param array $data
     * @param Page $page
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        Page $page,
        Data $helper,
        array $data = []
    ) {
        $this->_page = $page;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return Page|null
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
                if ($this->_helper->useTrailingSlashForHomepage()) {
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
