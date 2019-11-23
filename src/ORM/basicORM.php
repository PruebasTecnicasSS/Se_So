<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23/11/19
 * Time: 9:54
 */

namespace App\Orm;


use App\Entity\Tbookmarks;
use Doctrine\DBAL\DBALException;


class basicORM
{

    const KYES = 'Y';
    const KNO  = 'N';



    /**
     * @param $entityManager
     * @param $oEntity
     * @param $sError
     * @return bool
     */
    private function delete($entityManager, $oEntity, &$sError)
    {
        try {

            $entityManager->remove($oEntity);
            $entityManager->flush($oEntity);

            return true;

        } catch (\Exception $ex) {
            $sError = $ex->getMessage();

            return false;
        }
    }

    /**
     * @param $entityManager
     * @param $oEntity
     * @param $sError
     * @return bool
     */
    private function persist($entityManager, $oEntity, &$sError)
    {
        try {

            $entityManager->persist($oEntity);
            $entityManager->flush($oEntity);

            return $oEntity->getId();

        } catch (\Exception $ex) {
            $sError = $ex->getMessage();

            return false;
        }
    }


    /*****************************************************************************
     * BOOKMARKS
     *****************************************************************************/


    /**
     * @param $entityManager
     * @param bool $idUrl
     * @return mixed
     */
    public function getBookmarks($entityManager, $idUrl = false)
    {
        //get one url
        if ($idUrl) {
            $aUrl = $entityManager
                ->getRepository(Tbookmarks::class)
                ->find($idUrl);

        } else {
            //get all urls
            $aUrl = $entityManager
                ->getRepository(Tbookmarks::class)
                ->findAll();
        }

        return $aUrl;

    }

    /**
     * @param $entityManager
     * @param $sUrl
     * @param $sError
     * @return bool
     */
    public function saveUrl($entityManager, $sUrl, &$sError)
    {

        try {
            //generate new object
            $entity = new Tbookmarks();

            //set url
            $entity->setUrl($sUrl);

            //save
            return $this->persist($entityManager, $entity, $sError);

        } catch (\Exception $e) {

            $sError .= $e->getMessage();

            return false;

        }

    }

    /**
     * @param $entityManager
     * @param $idUrl
     * @param $sError
     * @return mixed
     */
    public function deleteUrl($entityManager, $idUrl, &$sError)
    {
        //get url
        $entity = $this->getBookmarks($entityManager, $idUrl);

        return $this->delete($entityManager, $entity, $sError);

    }


    /**
     * @param $entityManager
     * @param $sUrl
     * @param $idUrl
     * @param $sError
     * @return mixed
     */
    public function editUrl($entityManager, $sUrl, $idUrl, &$sError)
    {
        //get url
        $entity = $this->getBookmarks($entityManager, $idUrl);

        //set url
        $entity->setUrl($sUrl);

        return $this->persist($entityManager, $entity, $sError);

    }


}
