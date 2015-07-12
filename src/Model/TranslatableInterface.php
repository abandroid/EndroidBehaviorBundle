<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

interface TranslatableInterface
{
    /**
     * Checks if the entity has a translation.
     *
     * @param $translation
     *
     * @return bool
     */
    public function hasTranslation(TranslationInterface $translation);

    /**
     * Adds a translation.
     *
     * @param $translation
     *
     * @return TranslatableInterface
     */
    public function addTranslation(TranslationInterface $translation);

    /**
     * Returns the translation with the given locale.
     *
     * @param $locale
     *
     * @return TranslationInterface
     */
    public function getTranslation($locale);

    /**
     * Returns all translations.
     *
     * @return ArrayCollection
     */
    public function getTranslations();
}
