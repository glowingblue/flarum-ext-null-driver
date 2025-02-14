<?php

/*
 * This file is part of glowingblue/null-driver.
 *
 * Copyright (c) Glowing Blue AG.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace GlowingBlue\NullDriver\Console;

use Flarum\Console\AbstractCommand;
use Flarum\Settings\SettingsRepositoryInterface;

class ToggleNotificationsCommand extends AbstractCommand
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setName('notifications:disable')
            ->setAliases(['notifications:enable'])
            ->setDescription('Disable or enable forum notifications.');
    }

    protected function fire(): void
    {
        $commandName = $this->input->getFirstArgument();
        $settingKey = 'glowingblue-null-driver.forum-notifications.enabled';

        $currentState = (bool) $this->settings->get($settingKey);
        $desiredState = $commandName === 'notifications:disable' ? false : true;

        if ($currentState === $desiredState) {
            $state = $desiredState ? 'enabled' : 'disabled';
            $this->error("Notifications are already $state.");

            return;
        }

        $this->settings->set($settingKey, $desiredState);
        $action = $desiredState ? 'enabled' : 'disabled';
        $this->info("Notifications $action successfully.");
    }
}
