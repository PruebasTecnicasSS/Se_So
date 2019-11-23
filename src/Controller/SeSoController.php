<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23/11/19
 * Time: 9:19
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Orm\basicORM;

/**
 * @Route("/")
 */
class SeSoController extends Controller
{

    /**
     * @Route("/", name="obtener_bookmarks")
     *
     */
    public function bookmarksAction(Request $request, basicORM $ORM, EntityManagerInterface $entityManager)
    {

        $aBookmarks = $ORM->getBookmarks($entityManager);

        return $this->render('/bookmarks.html.twig', array('data' => $aBookmarks));
    }

    /**
     * @Route("/addUrl", name="add_url")
     *
     */
    public function addUrlAction(Request $request, basicORM $ORM, EntityManagerInterface $entityManager)
    {
        //get all request
        $aUrlParam = $request->request->all();
        $sError    = '';

        //get param
        $sUrl      = $aUrlParam['url'];

        //save data
        $bSaveUrl = $ORM->saveUrl($entityManager, $sUrl, $sError);

        if ($bSaveUrl) {
            return new Response('OK', Response::HTTP_OK);
        } else {
            return new Response($sError, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Route("/editUrl", name="edit_url")
     *
     */
    public function editUrlAction(Request $request, basicORM $ORM, EntityManagerInterface $entityManager)
    {
        //get all request
        $aUrlParam = $request->request->all();
        $sError    = '';

        //get param
        $sUrl      = $aUrlParam['url'];
        $nIdUrl    = $aUrlParam['id'];

        //save data
        $bSaveUrl = $ORM->editUrl($entityManager, $sUrl, $nIdUrl, $sError);

        if ($bSaveUrl) {
            return new Response('OK', Response::HTTP_OK);
        } else {
            return new Response($sError, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/delete", name="delete_url")
     *
     */
    public function deleteAction(Request $request, basicORM $ORM)
    {
        $nIdUrl = $request->get('id', null);

        $bDelete = $ORM->deleteUrl($this->entityManagerCustomer(), $nIdUrl, $sError);

        if ($bDelete) {
            return new Response('OK', Response::HTTP_OK);
        } else {
            return new Response($sError, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Route("/exportXML", name="export_url")
     */
    public function exportXML(Request $request, basicORM $ORM, EntityManagerInterface $entityManager)
     {
        //get urls fromm db
         $aBookmarks = $ORM->getBookmarks($entityManager);

         //create a XMl object
         $objetoXML = new \XMLWriter();

         //configure XML
         $objetoXML->openMemory();
         $objetoXML->setIndent(true);
         $objetoXML->setIndentString("\t");
         $objetoXML->startDocument('1.0', 'ISO-8859-1');

         //begin to save data
         $objetoXML->startElement('BOOKMARKS');
         foreach ($aBookmarks as $bookmark) {
             $objetoXML->startElement('URL');
             $objetoXML->text($bookmark->getUrl());
             $objetoXML->endElement();
             $objetoXML->startElement('DATE');
             $objetoXML->text($bookmark->getDate());
             $objetoXML->endElement();
         }
        //end save data
         $objetoXML->endElement();//

         //end document
         $objetoXML->endDocument();

         //get XML into string
         $XML = trim($objetoXML->outputMemory());

         //create response
         $response = new Response($XML);
         $response->headers->set('Content-Type', 'xml');

         return $response;

    }


}