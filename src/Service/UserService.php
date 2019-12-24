<?php


namespace App\Service;


use App\Entity\User;
use App\Exception\UserException;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserException
     */
    public function save(User $user): User
    {
        $user->setCreationdate(new \DateTime());
        try {
            $this->userRepository->save($user);
        } catch (ORMException | OptimisticLockException $ex) {
            throw new UserException();
        }

        return $user;
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        if(is_null($orderBy)) {
            $orderBy = ['creationdate' => 'desc'];
        }

        return $this->userRepository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findById(int $id) :?User {
        return  $this->userRepository->find($id);
    }

    /**
     * @param int $id
     * @throws UserException
     */
    public function deleteById(int $id): void
    {
        $user = $this->findById($id);

        if(is_null($user)) {
            throw new UserException('Filed to find user for given id.');
        }

        try {
            $this->userRepository->delete($user);
        } catch (ORMException $ex) {
            throw new UserException('Filed to delete user.');
        }

    }
}
