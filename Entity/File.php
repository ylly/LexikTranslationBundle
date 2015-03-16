<?php

namespace Lexik\Bundle\TranslationBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Lexik\Bundle\TranslationBundle\Model\File as FileModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @UniqueEntity(fields={"hash"})
 * @ORM\Table(name="lexik_translation_file",uniqueConstraints={
 *                  @ORM\UniqueConstraint(name="hash_idx",columns={"hash"})
 *            })
 * @ORM\Entity(repositoryClass="Lexik\Bundle\TranslationBundle\Entity\FileRepository")
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 *
 */
class File extends FileModel
{
    /**
     * {@inheritdoc}
     *
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * {@inheritdoc}
     *
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime("now");
    }
}
