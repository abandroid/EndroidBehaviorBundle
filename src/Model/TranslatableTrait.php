<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

trait TranslatableTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Object", mappedBy="translatable", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Checks if the entity has a translation.
     *
     * @param $translation
     *
     * @return bool
     */
    public function hasTranslation(TranslationInterface $translation)
    {
        return $this->translations->contains($translation);
    }

    /**
     * Adds a translation.
     *
     * @param $translation
     *
     * @return TranslatableInterface
     */
    public function addTranslation(TranslationInterface $translation)
    {
        $this->translations->add($translation);

        if ($translation->getTranslatable() != $this) {
            $translation->setTranslatable($this);
        }

        return $this;
    }

    /**
     * Returns the translation with the given locale.
     *
     * @param $locale
     *
     * @return TranslationInterface
     */
    public function getTranslation($locale)
    {
        foreach ($this->translations as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return;
    }

    /**
     * Returns all translations.
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
