<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Validators;

/**
 * Class UrlValidator
 * @package Sonrisa\Component\Sitemap\Validators
 */
class UrlValidator extends AbstractValidator
{
    /**
     * @var array
     */
    protected static $changeFreqValid = array("always","hourly","daily","weekly","monthly","yearly","never");

    /**
     * @param $lastmod
     * @return string
     */
    public static function validateLastmod($lastmod)
    {
        return self::validateDate($lastmod);
    }

    /**
     * @param $changefreq
     * @return string
     */
    public static function validateChangefreq($changefreq)
    {
        if ( in_array(trim(strtolower($changefreq)),self::$changeFreqValid,true) ) {
            return htmlentities($changefreq);
        }

        return '';
    }

    /**
     * The priority of a particular URL relative to other pages on the same site.
     * The value for this element is a number between 0.0 and 1.0 where 0.0 identifies the lowest priority page(s).
     * The default priority of a page is 0.5. Priority is used to select between pages on your site.
     * Setting a priority of 1.0 for all URLs will not help you, as the relative priority of pages on your site is what will be considered.
     *
     * @param string $priority
     *
     * @return string
     */
    public static function validatePriority($priority)
    {
        preg_match('/([0-9].[0-9])/', $priority, $matches);

        if (!empty($matches[0]) && ($matches[0]<1.1) && ($matches[0]>0.0) ) {
            return $matches[1];
        } else {
            return 0.5;
        }
    }
} 