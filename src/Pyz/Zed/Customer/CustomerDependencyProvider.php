<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer;

use Spryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Customer\AvailabilityNotificationSubscriptionCustomerTransferExpanderPlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\CustomerAnonymizer\AvailabilityNotificationAnonymizerPlugin;
use Spryker\Zed\Customer\CustomerDependencyProvider as SprykerCustomerDependencyProvider;
use Spryker\Zed\CustomerGroup\Communication\Plugin\CustomerAnonymizer\RemoveCustomerFromGroupPlugin;
use Spryker\Zed\CustomerUserConnector\Communication\Plugin\CustomerTransferUsernameExpanderPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Newsletter\Communication\Plugin\CustomerAnonymizer\CustomerUnsubscribePlugin;

class CustomerDependencyProvider extends SprykerCustomerDependencyProvider
{
    public const SALES_FACADE = 'sales facade';
    public const NEWSLETTER_FACADE = 'newsletter facade';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container->set(static::SALES_FACADE, function (Container $container) {
            return $container->getLocator()->sales()->facade();
        });

        $container->set(static::NEWSLETTER_FACADE, function (Container $container) {
            return $container->getLocator()->newsletter()->facade();
        });

        return $container;
    }

    /**
     * @return \Spryker\Zed\Customer\Dependency\Plugin\CustomerAnonymizerPluginInterface[]
     */
    protected function getCustomerAnonymizerPlugins()
    {
        return [
            new CustomerUnsubscribePlugin([
                NewsletterConstants::DEFAULT_NEWSLETTER_TYPE,
            ]),
            new RemoveCustomerFromGroupPlugin(),
            new AvailabilityNotificationAnonymizerPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Customer\Dependency\Plugin\CustomerTransferExpanderPluginInterface[]
     */
    protected function getCustomerTransferExpanderPlugins()
    {
        return [
            new CustomerTransferUsernameExpanderPlugin(),
            new AvailabilityNotificationSubscriptionCustomerTransferExpanderPlugin(),
        ];
    }
}
