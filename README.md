# The Emarsys Loyalty Wallet 

The Emarsys Loyalty Wallet is a full solution to a Loyalty program embedded in your website with very minimal javaScript. It provides the UI as well as everything else required to pull and push data to the Loyalty backend servers.

https://help.emarsys.com/hc/en-us/articles/360002736118-Installing-the-Loyalty-Wallet



## Magento Setup

### Manually
- create folder `app/code/Emarsys/LoyaltyWallet/`
- `cd app/code/Emarsys/LoyaltyWallet/`
- `git clone https://github.com/romastepa/emarsys-loyalty-wallet.git .`
### Composer
- `composer require emarsys/loyalty-wallet`

from magento root folder
- `bin/magento module:enable Emarsys_LoyaltyWallet`
- `bin/magento setup:upgrade`
- `bin/magento setup:di:compile`
- `bin/magento cache:c`



## Release Notes

### v1.0.7
- added csp_whitelist.xml
- added Plan Id, Country, Currency, Language

### v1.0.6
- contactId and customerId fixes

### v1.0.5
- code style fixes

### v1.0.4
- added Exclusive Access
- code style fixes

### v1.0.3
- added Exclusive Access
- code style fixes