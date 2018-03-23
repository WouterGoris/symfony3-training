<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Securty\Core\User\UserInterface;

/**
 * User
 * 
 * @ORM\Table(name"user")
 * @ORM\Entity(repositryClass="AppBundle\Repository\UserRepository")
 */

class User implements UserInterface, \Serializable
{
    /**
     * @var int
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

     private $id;

     /**
      * @var string
      * @ORM\Column(name="username", type="string", length=255, unique=true)
      */

      private $username;

      /**
       * @var string
       * @ORM\Column(name="password", type="string", length=64)
       */

       private $password;

       /**
        * @var string
        *@ORM\Column(name="email", type="string", length=255)
        */

        private $email;
}