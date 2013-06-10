<?php
/**
 * Date: 10/06/13
 * Time: 14:07
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */
namespace Site\BreadCrumbBundle\Entity;

interface PageInterface
{
    public function getTitle();

    public function getUrl();

    public function getParent();
}
