<?php 
namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ManagerRegistry;

class Register
{
    private $entityManager;
    public function __construct(ManagerRegistry $doctrine) {
        $this->entityManager =  $doctrine->getManager();
    }
    public function register (
        UserPasswordEncoderInterface $passwordEncoder, string $name, string $email, string $password
    ) : bool
    {
        try {
            if (!empty($this->entityManager->getRepository(User::class)->findBy(['email' => $email])))
            {
                throw new \Exception('This email address is reserved!');
            }
            else if (!empty($this->entityManager->getRepository(User::class)->findBy(['username' => $name])))
            {
                throw new \Exception('This username is reserved!');
            } else if (strlen($name) > 20)
            {
                throw new \Exception('Name can not have more than 20 characters!')  ;  
            } else if (strlen($name) < 1 ||  strlen($email) < 1)
            {
                throw new \Exception('All fields are required!');
            }  else if (strlen($password) < 6) {
                throw new \Exception('Password must have 6 characters at least!');
            } else {
                $user = new User();

                $user->setUsername($name);
                $user->setEmail($email);
                $user->setRoles(['ROLE_USER']);

                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $password
                    )
                );

                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }     
            
            
            return true;
        } catch (\Exception $exception) {
            throw $exception;

            return false;
        }
    }
}