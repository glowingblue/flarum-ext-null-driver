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
use Flarum\Mail\NullDriver;

class NullDriverProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->container->extend('mail.supported_drivers', function ($drivers) {
            return array_merge($drivers, ['null' => NullDriver::class]);
        });
    }
}
