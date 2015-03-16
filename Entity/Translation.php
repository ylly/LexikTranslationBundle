<?php

namespace Lexik\Bundle\TranslationBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Lexik\Bundle\TranslationBundle\Model\Translation as TranslationModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * @UniqueEntity(fields={"transUnit", "locale"})
 *
 * @ORM\Table(name="lexik_trans_unit_translations",uniqueConstraints={
 *                  @ORM\UniqueConstraint(name="trans_unit_locale_idx",columns={"trans_unit_id,locale"})
 *            })
 * @ORM\Entity(repositoryClass="Lexik\Bundle\TranslationBundle\Entity\TranslationRepository")
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class Translation extends TranslationModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Lexik\Bundle\TranslationBundle\Entity\TransUnit
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\TransUnit", inversedBy="translations", cascade={"all"})
     * @ORM\JoinColumn(fieldName="trans_unit_id", referencedColumnName="id")
     */
    protected $transUnit;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set transUnit
     *
     * @param Lexik\Bundle\TranslationBundle\Entity\TransUnit $transUnit
     */
    public function setTransUnit(\Lexik\Bundle\TranslationBundle\Model\TransUnit $transUnit)
    {
        $this->transUnit = $transUnit;
    }

    /**
     * Get transUnit
     *
     * @return Lexik\Bundle\TranslationBundle\Entity\TransUnit
     */
    public function getTransUnit()
    {
        return $this->transUnit;
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
