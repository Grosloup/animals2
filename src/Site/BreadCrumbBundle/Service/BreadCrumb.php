<?php
/**
 * Date: 10/06/13
 * Time: 14:23
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\BreadCrumbBundle\Service;


class BreadCrumb
{

    protected $templateEngine;

    protected $xmlPagesTree;

    protected $templateFile;

    public function __construct($templateEngine, $xmlPagesTree, $templateFile)
    {
        $this->templateEngine = $templateEngine;
        $this->xmlPagesTree = $xmlPagesTree;
        $this->templateFile = $templateFile;
    }

    public function test()
    {
        return $this->xmlPagesTree;
    }

    public function getTemplate()
    {
        return $this->templateFile;
    }
}
