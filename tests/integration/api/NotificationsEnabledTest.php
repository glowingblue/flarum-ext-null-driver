<?php

namespace GlowingBlue\NullDriver\Tests\integration\api;

use Carbon\Carbon;
use Flarum\Notification\Notification;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Flarum\User\User;


class NotificationsEnabledTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    public function setUp(): void
    {
        parent::setUp();

        $this->extension('glowingblue-null-driver');

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
            ],
            'discussion_user' => [
                ['user_id' => 2, 'discussion_id' => 1, 'last_read_post_number' => 1, 'last_read_at' => Carbon::now()->toDateTimeString()],
            ],
            'discussions' => [
                ['id' => 1, 'title' => 'The quick brown fox jumps over the lazy dog', 'created_at' => Carbon::now()->toDateTimeString(), 'user_id' => 2, 'participant_count' => 1],
            ],
            'posts' => [
                ['id' => 1, 'discussion_id' => 1, 'user_id' => 2, 'type' => 'comment', 'content' => '<t><p>Following</p></t>', 'is_private' => 0, 'number' => 1],
            ],
        ]);

        $this->setting('glowingblue-null-driver.forum-notifications.enabled', true);
    }

    /**
     * @test
     */
    public function notifications_are_sent_when_provider_enabled()
    {
        $response = $this->send(
            $this->request('PATCH', '/api/discussions/1', [
                'authenticatedAs' => 1,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'title'   => 'New discussion',
                        ],
                        'id'         => '1',
                        'type' => 'discussions',
                    ],
                ],
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $notificationRecipient = 2;

        $response = $this->send(
            $this->request('GET', '/api/notifications', [
                'authenticatedAs' => $notificationRecipient,
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $response = json_decode($response->getBody(), true);

        $this->assertEquals(1, count($response['data']));
        $this->assertEquals(1, User::query()->find($notificationRecipient)->notifications()->count());
        $this->assertEquals(1, Notification::query()->count());
    }
}
