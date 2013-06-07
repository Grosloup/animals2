<?php
/**
 * Date: 07/06/13
 * Time: 23:03
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

interface CRUDInterface {
    public function indexAction();
    public function showAction($id);
    public function newAction();
    public function createAction(Request $request);
    public function editAction($id);
    public function updateAction($id, Request $request);
    public function deleteAction($id, Request $request);
}
