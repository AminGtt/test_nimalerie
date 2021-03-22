<?php


namespace App\Service;


use Cocur\Slugify\Slugify;

class SluggerService
{
    public function getSlug($name): string {
        $slugify = new Slugify();
        return $slugify->slugify($name);
    }
}
