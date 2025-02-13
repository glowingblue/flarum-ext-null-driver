<?php

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
        $settingKey  = 'glowingblue-null-driver.forum-notifications.enabled';

        $current = (bool) $this->settings->get($settingKey);

        if ($commandName === 'notifications:disable') {
            if (!$current) {
                $this->error('Notifications are already disabled.');
            } else {
                $this->settings->set($settingKey, false);
                $this->info('Notifications disabled successfully.');
            }
        } elseif ($commandName === 'notifications:enable') {
            if ($current) {
                $this->error('Notifications are already enabled.');
            } else {
                $this->settings->set($settingKey, true);
                $this->info('Notifications enabled successfully.');
            }
        }
    }
}