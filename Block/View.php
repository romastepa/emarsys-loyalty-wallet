<?php

declare(strict_types=1);

/**
 * @category   Emarsys
 * @package    Emarsys_LoyaltyWallet
 * @copyright  Copyright (c) 2020 Emarsys. (http://www.emarsys.net/)
 */

namespace Emarsys\LoyaltyWallet\Block;

use Magento\{
    Framework\Exception\NoSuchEntityException,
    Framework\View\Element\Template,
    Framework\View\Element\Template\Context,
    Store\Model\StoreManagerInterface
};

class View extends Template
{
    /**
     * XML Path to LoyaltyWallet configurations
     */
    const XPATH_LOYALTY_WALLET_ENABLED = 'emarsys_loyalty_wallet/settings/enable';
    const XPATH_LOYALTY_WALLET_APPID = 'emarsys_loyalty_wallet/settings/appid';
    const XPATH_LOYALTY_WALLET_SECRET = 'emarsys_loyalty_wallet/settings/secret';
    const XPATH_LOYALTY_WALLET_CUSTOMERID = 'emarsys_loyalty_wallet/settings/customerid';
    const XPATH_LOYALTY_WALLET_TEST = 'emarsys_loyalty_wallet/settings/test';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        $this->storeManager = $context->getStoreManager();
        parent::__construct($context, $data);
    }

    /**
     * Is LoyaltyWallet enabled
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isEnable(): bool
    {
        return (bool)$this->storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_ENABLED);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getAppId(): string
    {
        return (string)$this->storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_APPID);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getSecret(): string
    {
        return (string)$this->storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_SECRET);
    }


    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getCustomerId(): string
    {
        return (string)$this->storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_CUSTOMERID);
    }

    /**
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isTest(): bool
    {
        return (bool)$this->storeManager->getStore()->getConfig(self::XPATH_LOYALTY_WALLET_TEST);
    }
}
