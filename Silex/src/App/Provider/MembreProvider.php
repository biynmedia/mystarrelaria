<?php
/**
 * Created by PhpStorm.
 * User: Hugo LIEGEARD
 * Date: 06/02/2018
 * Time: 10:54
 */

namespace App\Provider;


use App\Model\Membre;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class MembreProvider implements UserProviderInterface
{

    private $_db;

    /**
     * Récupération de l'instance de la BDD
     * @param $db Idiorm ou Doctrine DBAL
     */
    public function __construct($db)
    {
        $this->_db = $db;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($EMAILMEMBRE)
    {
        # Je récupère l'auteur par rapport a son username
        $membre = $this->_db->for_table('membre')
            ->where('EMAILMEMBRE', $EMAILMEMBRE)
            ->find_one();

        # Je vérifie que l'utilisateur soit trouvé.
        if(empty($membre)) :
            throw new UsernameNotFoundException(
                sprintf('Cet utilisateur "%s" n\'existe pas.',
                    $EMAILMEMBRE)
            );
        endif;
        # Si tout est bon, je retourne une instance de Auteur
        return new Membre($membre->IDMEMBRE, $membre->NOMMEMBRE,
            $membre->PRENOMMEMBRE, $membre->EMAILMEMBRE,
            $membre->MDPMEMBRE, $membre->PHOTOMEMBRE, $membre->ROLEMEMBRE,
            $membre->DATEINSCRIPTION, $membre->LASTCOMEMBRE, $membre->LASTIPMEMBRE);
    }

    /**
     * Refreshes the user.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the user is not supported
     */
    public function refreshUser(UserInterface $membre)
    {
        # On s'assure de bien avoir un Objet Auteur
        if(!$membre instanceof Membre) :
            throw new UnsupportedUserException(
                sprintf('Les instance de "%s" ne sont pas autorisées.',
                    getClass($membre))
            );
        endif;
        # Si tous est correct, je peux charger l'utilisateur via son username.
        return $this->loadUserByUsername($membre->getUsername());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === Membre::class;
    }
}