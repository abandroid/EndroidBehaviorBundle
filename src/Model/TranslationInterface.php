<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

interface TranslationInterface
{
    /**
     * Sets the locale.
     *
     * @param $locale
     *
     * @return TranslatableInterface
     */
    public function setLocale($locale);

    /**
     * Returns the locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Sets the translatable subject.
     *
     * @param $translatable
     *
     * @return TranslationInterface
     */
    public function setTranslatable(TranslatableInterface $translatable);

    /**
     * Returns the translatable subject.
     *
     * @return TranslatableInterface
     */
    public function getTranslatable();
}
