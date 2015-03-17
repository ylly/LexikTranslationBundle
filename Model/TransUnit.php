<?php

namespace Lexik\Bundle\TranslationBundle\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represent a trans unit which contain translations for a given domain and key.
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
abstract class TransUnit
{
    /**
     * <unique-constraints>
    <unique-constraint name="key_domain_idx" columns="key_name,domain" />
    </unique-constraints>

     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="key_name", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    protected $key;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    protected $domain;

    /**
     * @var Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Lexik\Bundle\TranslationBundle\Entity\Translation", mappedBy="transUnit", cascade={"all"})
     */
    protected $translations;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->domain = 'messages';
        $this->translations = new ArrayCollection();
    }

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
     * Set key name
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get key name
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set domain
     *
     * @param string $domain
     */
    public function setDomain($domain)
    {
      $this->domain = $domain;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
      return $this->domain;
    }

    /**
     * Add translations
     *
     * @param Lexik\Bundle\TranslationBundle\Model\Translation $translations
     */
    public function addTranslation(\Lexik\Bundle\TranslationBundle\Model\Translation $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * Remove translations
     *
     * @param Lexik\Bundle\TranslationBundle\Model\Translation $translations
     */
    public function removeTranslation(\Lexik\Bundle\TranslationBundle\Model\Translation $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Return true if this object has a translation for the given locale.
     *
     * @param string $locale
     * @return boolean
     */
    public function hasTranslation($locale)
    {
        return null !== $this->getTranslation($locale);
    }

    /**
     * Return the content of translation for the given locale.
     *
     * @param string $locale
     * @return Lexik\Bundle\TranslationBundle\Model\Translation
     */
    public function getTranslation($locale)
    {
        foreach ($this->getTranslations() as $translation) {

            if ($translation->getLocale() == $locale) {

                return $translation;
            }
        }

        return null;
    }

    /**
     * Set translations collection
     *
     * @param Collection $collection
     */
    public function setTranslations(Collection $collection)
    {
        $this->translations = new ArrayCollection();

        foreach ($collection as $translation) {
            $this->addTranslation($translation);
        }
    }

    /**
     * Return transaltions with  not blank content.
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function filterNotBlankTranslations()
    {
        return $this->getTranslations()->filter(function ($translation) {
            $content = $translation->getContent();
            return !empty($content);
        });
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
