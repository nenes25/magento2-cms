<?php
namespace Hhennes\Cms\Helper;

use Magento\Store\Model\ScopeInterface;

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
     * Cms canonical use trailing slash for homepage config path
     */
    const XML_PATH_CANONICAL_USE_TRAILING_SLASH_HOMEPAGE = 'cms/canonical/use_trailing_slash_homepage';

    /**
     * Return if canonical url is enabled
     * @return bool
     */
    public function isCanonicalUrlEnable()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_CANONICAL_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return if we use the trailing slash
     * @return bool
     */
    public function useTrailingSlash()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_CANONICAL_USE_TRAILING_SLASH,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Return if we use the trailing slash for the homepage
     * @return bool
     */
    public function useTrailingSlashForHomepage()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_CANONICAL_USE_TRAILING_SLASH_HOMEPAGE,
            ScopeInterface::SCOPE_STORE
        );
    }
}
