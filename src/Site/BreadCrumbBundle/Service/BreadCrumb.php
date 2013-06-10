<?php
/**
 * Date: 10/06/13
 * Time: 14:23
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\BreadCrumbBundle\Service;


use Symfony\Component\Config\FileLocator;

class BreadCrumb
{

    /**
     * @var \Twig_Environment
     */
    protected $templateEngine;

    protected $xmlPagesTree;

    protected $templateFile;

    protected $pages = [];

    protected $pagesById = [];

    public function __construct($templateEngine, $xmlPagesTree, $templateFile)
    {
        $this->templateEngine = $templateEngine;
        //$this->xmlPagesTree = $xmlPagesTree;
        $locator = new FileLocator();

        $this->xmlPagesTree = $locator->locate($xmlPagesTree);
        $this->processXml();
        $this->templateFile = $templateFile;
    }

    public function render($routeName)
    {
        if(empty($this->pages[$routeName])){
            return "";
        }
        $pages = [];
        $id = $this->pages[$routeName]["id"];
        $pages[] = ["title"=>$this->pagesById[$id]["title"], "route"=>$routeName];
        if($this->hasParent($id)){
            $this->loadParent($id, $pages);
        }
        $pages = array_reverse($pages);

        return $this->templateEngine->render($this->templateFile,["pages"=>$pages]);
    }

    protected function loadParent($id, &$pages)
    {
        $parentId = $this->pagesById[$id]["parent"];
        $pages[] = ["title"=>$this->pagesById[$parentId]["title"], "route"=>$this->pagesById[$parentId]["route"]];
        if($this->hasParent($parentId)){
            $this->loadParent($parentId, $pages);
        }
    }

    public function getXmlPagesTreePath()
    {
        return $this->xmlPagesTree;
    }

    protected function processXml()
    {
        $pages = \simplexml_load_file($this->xmlPagesTree);
        if($pages->count() > 0){
            foreach($pages as $page){
                $tmp = [];
                $tmp["id"] =  (string)$page["id"];
                $tmp["title"] = (string)$page["title"];
                $tmp["parent"] = (string)$page["parent"] == "null" ? null : (string)$page["parent"];
                $tmp["route"] = (string)$page["route"];
                $this->pages[(string)$page["route"]] = $tmp;
                $this->pagesById[(string)$page["id"]] = $tmp;
            }

        }
    }

    protected function hasParent($id)
    {
        return $this->pagesById[$id]["parent"] !== null;
    }

}
