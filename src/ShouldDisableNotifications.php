<?php

namespace GlowingBlue\NullDriver;

use Flarum\Settings\SettingsRepositoryInterface;

class ShouldDisableNotifications
{
    public function __invoke(SettingsRepositoryInterface $settings): bool
{
    return (bool) ! $settings->get('glowingblue-null-driver.forum-notifications.enabled');
}
}