<?php

namespace BlogBundle\Provider;

/**
 * Created by PhpStorm.
 * User: geoffroycochard
 * Date: 29/11/2016
 * Time: 09:52
 */
class SlugifierProvider
{
    public function slugify($name)
    {
        $slug = strtolower($name);

        $slug = preg_replace("/[^a-z0-9s-]/", "", $slug);
        $slug = trim(preg_replace("/[s-]+/", " ", $slug));
        $slug = preg_replace("/s/", "-", $slug);

        return $slug;
    }
}