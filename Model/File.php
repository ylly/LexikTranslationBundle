<?php

namespace Lexik\Bundle\TranslationBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Base File class.
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
abstract class File
{

    /**
     *
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
     * @ORM\Column(name="domain", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    protected $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=10)
     *
     * @Assert\NotBlank()
     */
    protected $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="extention", type="string", length=10)
     *
     * @Assert\NotBlank()
     */
    protected $extention;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)

     * @Assert\NotBlank()
     */
    protected $path;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    protected $hash;

    /**
     * @var Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Lexik\Bundle\TranslationBundle\Entity\Translation", mappedBy="file", cascade={"persist"})
     */
    protected $translations;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set extention
     *
     * @param string $extention
     */
    public function setExtention($extention)
    {
        $this->extention = $extention;
    }

    /**
     * Get extention
     *
     * @return string
     */
    public function getExtention()
    {
        return $this->extention;
    }

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file name
     *
     * @param string $name
     */
    public function setName($name)
    {
        list($domain, $locale, $extention) = explode('.', $name);

        $this->domain = $domain;
        $this->locale = $locale;
        $this->extention = $extention;
    }

    /**
     * Get file name
     *
     * @return string
     */
    public function getName()
    {
        return sprintf('%s.%s.%s', $this->domain, $this->locale, $this->extention);
    }

    /**
     * Set hash
     *
     * @return string
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Add translation
     *
     * @param Lexik\Bundle\TranslationBundle\Model\Translation $translation
     */
    public function addTranslation(\Lexik\Bundle\TranslationBundle\Model\Translation $translation)
    {
        $translation->setFile($this);

        $this->translations[] = $translation;
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
