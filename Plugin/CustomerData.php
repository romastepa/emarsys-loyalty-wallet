<?php
declare(strict_types=1);

/**
 * @category   Emarsys
 * @package    Emarsys_LoyaltyWallet
 * @copyright  Copyright (c) 2020 Emarsys. (http://www.emarsys.net/)
 */

namespace Emarsys\LoyaltyWallet\Plugin;

use Emarsys\LoyaltyWallet\Block\View\Proxy as LoyaltyWallet;
use Magento\Customer\CustomerData\Customer;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerData
{
    /**
     * @var CurrentCustomer
     */
    private $currentCustomer;

    /**
     * @var \Emarsys\LoyaltyWallet\Block\View
     */
    private $loyaltyWallet;

    /**
     * CustomerData constructor.
     *
     * @param CurrentCustomer $currentCustomer
     * @param LoyaltyWallet $loyaltyWallet
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        LoyaltyWallet $loyaltyWallet
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->loyaltyWallet = $loyaltyWallet;
    }

    /**
     * @param Customer $subject
     * @param array $result
     *
     * @return array
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterGetSectionData(Customer $subject, array $result): array
    {
        unset(
            $result['contactId'],
            $result['appid'],
            $result['time'],
            $result['token'],
            $result['customerId'],
            $result['region'],
            $result['planid'],
            $result['country'],
            $result['currency'],
            $result['language'],
        );

        if (!$this->loyaltyWallet->isEnable()
            || empty($this->loyaltyWallet->getAppId())
            || empty($this->loyaltyWallet->getSecret())
        ) {
            return $result;
        }

        $customerId = $this->currentCustomer->getCustomerId();

        if ($customerId) {
            $customer = $this->currentCustomer->getCustomer();
            $result['contactId'] = $customer->getEmail();
        }

        if ($this->loyaltyWallet->isTest()) {
            $result['contactId'] = 'sample1@loyalsys.io';
        }

        if (isset($result['contactId'])) {
            $planId = $this->loyaltyWallet->getPlanId();
            $time = time();

            $result['appid'] = $this->loyaltyWallet->getAppId();
            $result['time'] = $time;
            $result['token'] = hash_hmac(
                "sha256",
                $result['contactId'] . $planId . $time,
                $this->loyaltyWallet->getSecret()
            );
            $result['customerId'] = $this->loyaltyWallet->getCustomerId();
            $result['region'] = 'eu'; //TODO: add to config
            $result['planId'] = $planId;
            $result['country'] = $this->loyaltyWallet->getCountry();
            $result['currency'] = $this->loyaltyWallet->getCurrency();
            $result['language'] = $this->loyaltyWallet->getLanguage();
        }

        return $result;
    }
}
