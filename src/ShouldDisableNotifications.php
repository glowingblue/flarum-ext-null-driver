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

use Flarum\Settings\SettingsRepositoryInterface;

class ShouldDisableNotifications
{
    public function __invoke(SettingsRepositoryInterface $settings): bool
    {
        return (bool) !$settings->get('glowingblue-null-driver.forum-notifications.enabled');
    }
}
