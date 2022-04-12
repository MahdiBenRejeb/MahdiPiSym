<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Like
 *
 * @ORM\Table(name="like", indexes={@ORM\Index(name="Id_user", columns={"Id_user"}), @ORM\Index(name="Id_article", columns={"Id_article"})})
 * @ORM\Entity
 */
class Like
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_like", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLike;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_article", type="integer", nullable=false)
     */
    private $idArticle;


}
