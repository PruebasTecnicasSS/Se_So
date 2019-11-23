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
use Doctrine\Common\Util\Debug;
use Doctrine\ORM;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Orm\basicORM;

/**
 * @Route("/")
 */
class SeSoController extends Controller
{
    /**
     * @Route("/inicio")
     */
    public function number()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }


    /**
     * @Route("/inicio")
     */
    public function indexAction()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    /**
     * @Route("/bookmarks", name="obtener_bookmarks")
     *
     */
    public function bookmarksAction(Request $request, basicORM $ORM, EntityManagerInterface $entityManager)
    {

        $aBookmarks  = $ORM->getBookmarks($entityManager);

        return $this->render('/bookmarks.html.twig', array('bookmarks' => $aBookmarks));
    }


    /**
     * @Route("/editUrl", name="edit_url")
     *
     */
    public function editUrl(Request $request, basicORM $ORM, EntityManagerInterface $entityManager)
    {

        $aUrlParam = $request->request->all();
        $sError = '';

        $bSaveUrl = $ORM->saveUrl($entityManager, $aUrlParam, $sError);

        if ($bSaveUrl) {
            return new Response('OK', Response::HTTP_OK);
        } else {
            return new Response($sError, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    /**
     * @param $url
     * @return string
     */
    private function twitterling($url){

        $title = 'Title here';
        $short_url = 'http://shorturl.co';
        $url = 'http://fullurl.com';

        $twitter_params =
            '?text=' . urlencode($title) . '+-' .
            '&amp;url=' . urlencode($short_url) .
            '&amp;counturl=' . urlencode($url) .
            '';


        $link = "http://twitter.com/share" . $twitter_params . "";

        return $link;
    }


}