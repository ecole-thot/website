<?php

namespace App\Twig;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class UtilitiesExtension.
 *
 * This Twig extension provides the 'indicate' function that allows to create
 * class blocks according to the value of a parameter.
 */
class UtilitiesExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('localizeddate', [$this, 'generateLocalizedDate'], ['needs_environment' => true]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [];
    }

    /**
     * Generate a localized date based on the environment locale, with a ICU format
     * https://ssl.icu-project.org/apiref/icu4c/classSimpleDateFormat.html#details.
     *
     * @param Environment $env    The current environment
     * @param mixed       $date   The date
     * @param string      $format the ICU format
     * @param string      $locale the locale, if forced
     *
     * @return string the localized date
     */
    public function generateLocalizedDate(Environment $env, $date, string $format = null, string $locale = null)
    {
        $date = twig_date_converter($env, $date, null);
        $formatter = \IntlDateFormatter::create(
            $locale,
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            \IntlTimeZone::createTimeZone($date->getTimezone()->getName()),
            \IntlDateFormatter::GREGORIAN,
            $format
        );

        return $formatter->format($date->getTimestamp());
    }
}
