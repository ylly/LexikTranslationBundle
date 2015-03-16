<?php

namespace Lexik\Bundle\TranslationBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Lexik\Bundle\TranslationBundle\Model\TransUnit as TransUnitModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * @UniqueEntity(fields={"key", "domain"})
 *
 * @ORM\Table(name="lexik_trans_unit",uniqueConstraints={
 *                  @ORM\UniqueConstraint(name="key_domain_idx",columns={"key_name,domain"})
 *            })
 * @ORM\Entity(repositoryClass="Lexik\Bundle\TranslationBundle\Entity\TransUnitRepository")
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class TransUnit extends TransUnitModel
{
    /**
     * Add translations
     *
     * @param Lexik\Bundle\TranslationBundle\Entity\Translation $translations
     */
    public function addTranslation(\Lexik\Bundle\TranslationBundle\Model\Translation $translation)
    {
        $translation->setTransUnit($this);

        $this->translations[] = $translation;
    }

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
