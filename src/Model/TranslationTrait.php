<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

trait TranslationTrait
{
    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Object", inversedBy="translations", cascade={"persist"}, fetch="EAGER")
     */
    protected $translatable;

    /**
     * Sets the locale.
     *
     * @param $locale
     *
     * @return TranslatableInterface
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Returns the locale.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Sets the translatable subject.
     *
     * @param $translatable
     *
     * @return TranslationInterface
     */
    public function setTranslatable(TranslatableInterface $translatable)
    {
        $this->translatable = $translatable;

        if (!$translatable->hasTranslation($this)) {
            $translatable->addTranslation($this);
        }

        return $this;
    }

    /**
     * Returns the translatable subject.
     *
     * @return TranslatableInterface
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
}
