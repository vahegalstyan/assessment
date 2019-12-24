<?php


namespace App\Event;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserModifySubscriber implements EventSubscriberInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            UserModifyEvent::NAME => 'onUserModify',
        ];
    }

    public function onUserModify(UserModifyEvent $event)
    {
        $this->logger->info('User requested to modify data.', [
            'request_data' => $event->getRequest()->getContent()
        ]);
    }
}
