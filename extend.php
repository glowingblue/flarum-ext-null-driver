<?php

/*
 * This file is part of glowingblue/null-driver.
 *
 * Copyright (c) Glowing Blue AG.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace GlowingBlue\NullDriver;

use Flarum\Extend;
use GlowingBlue\NullDriver\Console\ToggleNotificationsCommand;
use GlowingBlue\NullDriver\Provider\NullEmailDriverProvider;
use GlowingBlue\NullDriver\Provider\NullNotificationProvider;
use GlowingBlue\NullDriver\ShouldDisableNotifications;

return [
    (new Extend\ServiceProvider())
        ->register(NullEmailDriverProvider::class),

    (new Extend\Console())
        ->command(ToggleNotificationsCommand::class),

    (new Extend\Settings)
        ->default('glowingblue-null-driver.forum-notifications.enabled', true),

    (new Extend\Conditional())
        ->when(new ShouldDisableNotifications(), fn () => [
            (new Extend\ServiceProvider())
                ->register(NullNotificationProvider::class),
        ]),
];
