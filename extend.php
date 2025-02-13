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
use GlowingBlue\NullDriver\Provider\NullEmailDriverProvider;

return [
    (new Extend\ServiceProvider())
        ->register(NullEmailDriverProvider::class)
];
