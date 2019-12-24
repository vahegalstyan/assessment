<?php


namespace App\Controller;


use App\Entity\User;
use App\Event\UserModifyEvent;
use App\Exception\UserException;
use App\Form\UserType;
use App\Service\UserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UserController
 * @Route("/api", name="api_")
 */
class UserController extends AbstractFOSRestController
{

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var EventDispatcherInterface
     */

    private $eventDispatcher;
    /**
     * @var LoggerInterface
     */

    private $logger;

    public function __construct(
        UserService $userService,
        EventDispatcherInterface $eventDispatcher,
        LoggerInterface $logger
    )
    {
        $this->userService = $userService;
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    /**
     * Create User.
     * @Rest\Post("/user")
     * @return Response
     */
    public function saveUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $event = new UserModifyEvent($request);
        $this->eventDispatcher->dispatch($event, UserModifyEvent::NAME);

        $requestData = json_decode($request->getContent(), true);
        $form->submit($requestData);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userService->save($form->getData());

            return $this->handleView($this->view([
                'data' => [
                    'user' => $user
                ]
            ], Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    /**
     * Delete User.
     * @Rest\Delete("/user/{id}")
     * @return Response
     */
    public function deleteUserAction($id)
    {
        try {
            $this->userService->deleteById($id);
        } catch (UserException $uEx) {
            $this->logger->error('Failed to delete user.', [
                'exception_message' => $uEx->getMessage(),
            ]);

            return $this->handleView(
                $this->view(['error' =>
                    $uEx->getMessage()
                ], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $ex) {
            $this->logger->critical('Failed to delete user.', [
                'exception_message' => $ex->getMessage(),
            ]);

            return $this->handleView(
                $this->view(['error' => [
                    'Failed to delete user.'
                ]
                ], Response::HTTP_INTERNAL_SERVER_ERROR));
        }
        return $this->handleView($this->view([], Response::HTTP_OK));

    }

    /**
     * List all Users.
     * @Rest\Get("/user")
     * @return Response
     */
    public function getUsersAction(Request $request)
    {
        $data = $request->query->all();
        $orderBy = $data['order_by'] ?? null;
        $order = $data['order'] ?? null;
        $orderParams = null;

        if (!is_null($orderBy) || !is_null($order)) {
            $orderParams = [$orderBy => $order];
        }

        try {
            $users = $this->userService->findBy([], $orderParams);
        } catch (\Throwable $ex) {
            return $this->handleView(
                $this->view(['error' => [
                    'Failed to find users.'
                ]
                ], Response::HTTP_INTERNAL_SERVER_ERROR));
        }

        return $this->handleView($this->view($users, Response::HTTP_OK));
    }

    /**
     * Get User.
     * @Rest\Get("/user/{id}")
     * @return Response
     */
    public function getUserAction(int $id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return $this->handleView(
                $this->view(['error' =>
                    'User not found'
                ], Response::HTTP_BAD_REQUEST));
        }

        return $this->handleView($this->view([
            'date' => [
                'user' => $user,
            ]
        ], Response::HTTP_OK));
    }
}
