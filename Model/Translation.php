<?php

namespace Lexik\Bundle\TranslationBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represent a translation for a given locale of a TransUnit object.
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
abstract class Translation
{
    /**
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="locale", type="string", length=10)
     */
    protected $locale;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"contentNotBlank"})
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @var Lexik\Bundle\TranslationBundle\Model\File
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\TranslationBundle\Entity\File", inversedBy="translations")
     * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     */
    protected $file;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->content = '';
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
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Set file
     *
     * @param \Lexik\Bundle\TranslationBundle\Model\File $file
     */
    public function setFile(\Lexik\Bundle\TranslationBundle\Model\File $file)
    {
        $this->file = $file;
    }

    /**
     * Get file
     *
     * @return \Lexik\Bundle\TranslationBundle\Model\File
     */
    public function getFile()
    {
        return $this->file;
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
