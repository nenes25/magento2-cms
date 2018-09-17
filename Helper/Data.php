<?php
namespace Hhennes\Cms\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Cms Enable Canonical config path
     */
    const XML_PATH_CANONICAL_ENABLED = 'cms/canonical/enable_canonical';

    /**
     * Cms canonical use trailing slash config path
     */
    const XML_PATH_CANONICAL_USE_TRAILING_SLASH = 'cms/canonical/use_trailing_slash';

    /**
     * Return if canonical url is enabled
     * @return bool
     */
    public function isCanonicalUrlEnable()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CANONICAL_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Return if we use the trailing slash
     * @return bool
     */
    public function useTrailingSlash()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_CANONICAL_USE_TRAILING_SLASH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}