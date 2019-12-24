<?php


namespace App\Event;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

class UserModifyEvent extends Event
{

    public const NAME = 'user.modify';
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest():Request
    {
        return  $this->request;
    }
}
