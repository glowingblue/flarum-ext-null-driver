<?php

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
