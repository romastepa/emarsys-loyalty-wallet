<?php
/**
 * @category   Emarsys
 * @package    Emarsys_LoyaltyWallet
 * @copyright  Copyright (c) 2020 Emarsys. (http://www.emarsys.net/)
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Emarsys_LoyaltyWallet',
    isset($file) ? dirname($file) : __DIR__
);
