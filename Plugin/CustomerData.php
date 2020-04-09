<?php

declare(strict_types=1);

/**
 * @category   Emarsys
 * @package    Emarsys_LoyaltyWallet
 * @copyright  Copyright (c) 2020 Emarsys. (http://www.emarsys.net/)
 */

namespace Emarsys\LoyaltyWallet\Plugin;

use Magento\{
    Customer\CustomerData\Customer,
    Customer\Model\Session,
    Framework\Exception\NoSuchEntityException
};
use Emarsys\LoyaltyWallet\Block\View\Proxy as LoyaltyWallet;

class CustomerData extends Customer
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var LoyaltyWallet
     */
    protected $loyaltyWallet;

    /**
     * CustomerData constructor.
     *
     * @param Session $session
     * @param LoyaltyWallet $loyaltyWallet
     */
    public function __construct(
        Session $session,
        LoyaltyWallet $loyaltyWallet
    ) {
        $this->session = $session;
        $this->loyaltyWallet = $loyaltyWallet;
    }

    /**
     * @param Customer $subject
     * @param array $result
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function afterGetSectionData(Customer $subject, $result): array
    {
        unset(
            $result['contactid'],
            $result['appid'],
            $result['time'],
            $result['token'],
            $result['customerId'],
            $result['region']
        );

        if (!$this->loyaltyWallet->isEnable()
            || empty($this->loyaltyWallet->getAppId())
            || empty($this->loyaltyWallet->getSecret())
        ) {
            return $result;
        }

        $customerId = $subject->currentCustomer->getCustomerId();
        if ($customerId) {
            $customer = $subject->currentCustomer->getCustomer();
            $result['contactid'] = $customer->getEmail();
        }

        if ($this->loyaltyWallet->isTest()) {
            $result['contactid'] = 'sample1@loyalsys.io';
        }

        if (isset($result['contactid'])) {
            $time = time();
            $result['appid'] = $this->loyaltyWallet->getAppId();
            $result['time'] = $time;
            $result['token'] = hash_hmac(
                "sha256",
                $result['contactid'] . $time,
                $this->loyaltyWallet->getSecret()
            );
            $result['customerId'] = $this->loyaltyWallet->getCustomerId();
            $result['region'] = 'eu'; //TODO: add to config
        }

        return $result;
    }
}
