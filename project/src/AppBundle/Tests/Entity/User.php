<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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
       * 
       * @ORM\Column(name="password", type="string", length=64)
       */

        private $password;

        /**
        * @var string

        *@ORM\Column(name="email", type="string", length=255)
        */

        private $email;

        /**
         * Get id
         * @return int
         */

        public function getId()
        {
            return $this->id;
        }

        /**
         * Set username
         * 
         * @param string $username
         * 
         * @return user
         */

         public function setUsername($username)
         {
             $this->username = $username;

             return $this;
         }

         public function getUsername()
         {
             return $this->username;
         }

         /**
          * lol
          */

          public function getPassword()
          {
                return $this->password;
          }

          public function setPassword($password)
          {
              $this->password = $password;
              return $this;
          }

          public function getEmail()
          {
              return $this->email;
          }

          public function setEmail($email)
          { 
              $this->email = $email;
              return $this;
          }





        public function serialize()
        {
            return serialize ([
                $this->id,
                $this->username,
                $this->password,
            ]);
        }

        public function unserialize($serialized)
        {
            list(
                $this->id,
                $this->username,
                $this->password,
            ) = unserialize($serialized);
        }
}