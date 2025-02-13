<?php

/*
 * This file is part of glowingblue/null-driver.
 *
 * Copyright (c) Glowing Blue AG.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace GlowingBlue\NullDriver\Provider;

use Flarum\Foundation\AbstractServiceProvider;

class NullNotificationProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->extend('flarum.notification.drivers', function ($drivers) {
            return [];
        });
    }
}
