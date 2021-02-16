<?php
declare(strict_types=1);

/**
 * @category   Emarsys
 * @package    Emarsys_LoyaltyWallet
 * @copyright  Copyright (c) 2020 Emarsys. (http://www.emarsys.net/)
 */

namespace Emarsys\LoyaltyWallet\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

class View extends Template
{
    /**
     * XML Path to LoyaltyWallet configurations
     */
    public const XPATH_LOYALTY_WALLET_ENABLED = 'emarsys_loyalty_wallet/settings/enable';
    public const XPATH_LOYALTY_WALLET_APPID = 'emarsys_loyalty_wallet/settings/appid';
    public const XPATH_LOYALTY_WALLET_SECRET = 'emarsys_loyalty_wallet/settings/secret';
    public const XPATH_LOYALTY_WALLET_CUSTOMERID = 'emarsys_loyalty_wallet/settings/customerid';
    public const XPATH_LOYALTY_WALLET_TEST = 'emarsys_loyalty_wallet/settings/test';
    public const XPATH_LOYALTY_WALLET_PLANID = 'emarsys_loyalty_wallet/settings/planid';
    public const XPATH_LOYALTY_WALLET_COUNTRY = 'emarsys_loyalty_wallet/settings/country_id';

    /**
     * Is LoyaltyWallet enabled
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isEnable(): bool
    {
        return (bool)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_ENABLED);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getAppId(): string
    {
        return (string)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_APPID);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getSecret(): string
    {
        return (string)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_SECRET);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getCustomerId(): string
    {
        return (string)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_CUSTOMERID);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getPlanId(): string
    {
        return (string)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_PLANID);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getCountry(): string
    {
        return (string)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_COUNTRY);
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getCurrency(): string
    {
        return (string)$this->_storeManager->getStore()->getCurrentCurrency()->getCode();
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getLanguage(): string
    {
        $language = (string)$this->_storeManager->getStore()
            ->getConfig(\Magento\Directory\Helper\Data::XML_PATH_DEFAULT_LOCALE);

        return substr($language, 0, strpos($language, '_'));
    }

    /**
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isTest(): bool
    {
        return (bool)$this->_storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_TEST);
    }
}
