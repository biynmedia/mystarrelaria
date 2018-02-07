<?php
/**
 * Created by PhpStorm.
 * User: guill
 * Date: 17/01/2018
 * Time: 14:32
 */

namespace App\Model;


class Artiste
{

    private $IDARTISTE;
    private $PSEUDOARTISTE;
    private $ALIASARTISTE;
    private $TELARTISTE;
    private $DESCARTISTE;
    private $BIOARTISTE;
    private $genre_IDGENRE;
    private $membre_IDMEMBRE;
    private $SITEINTERNETARTISTE;
    private $FACEBOOKARTISTE;
    private $SOUNDCLOUDARTISTE;
    private $YOUTUBEARTISTE;
    private $SNAPCHATARTISTE;
    private $INSTAGRAMARTISTE;
    private $PRENOMMANAGER;
    private $EMAILMANAGER;
    private $IMAGEARTISTE;
    private $TELMANAGER;

    /**
     * Artiste constructor.
     * @param $IDARTISTE
     * @param $PSEUDOARTISTE
     * @param $ALIASARTISTE
     * @param $TELARTISTE
     * @param $DESCARTISTE
     * @param $BIOARTISTE
     * @param $genre_IDGENRE
     * @param $membre_IDMEMBRE
     * @param $SITEINTERNETARTISTE
     * @param $FACEBOOKARTISTE
     * @param $SOUNDCLOUDARTISTE
     * @param $YOUTUBEARTISTE
     * @param $SNAPCHATARTISTE
     * @param $INSTAGRAMARTISTE
     * @param $PRENOMMANAGER
     * @param $EMAILMANAGER
     * @param $IMAGEARTISTE
     * @param $TELMANAGER
     */
    public function __construct($IDARTISTE, $PSEUDOARTISTE, $ALIASARTISTE, $TELARTISTE, $DESCARTISTE, $BIOARTISTE, $genre_IDGENRE, $membre_IDMEMBRE, $SITEINTERNETARTISTE, $FACEBOOKARTISTE, $SOUNDCLOUDARTISTE, $YOUTUBEARTISTE, $SNAPCHATARTISTE, $INSTAGRAMARTISTE, $PRENOMMANAGER, $EMAILMANAGER, $IMAGEARTISTE, $TELMANAGER)
    {
        $this->IDARTISTE = $IDARTISTE;
        $this->PSEUDOARTISTE = $PSEUDOARTISTE;
        $this->ALIASARTISTE = $ALIASARTISTE;
        $this->TELARTISTE = $TELARTISTE;
        $this->DESCARTISTE = $DESCARTISTE;
        $this->BIOARTISTE = $BIOARTISTE;
        $this->genre_IDGENRE = $genre_IDGENRE;
        $this->membre_IDMEMBRE = $membre_IDMEMBRE;
        $this->SITEINTERNETARTISTE = $SITEINTERNETARTISTE;
        $this->FACEBOOKARTISTE = $FACEBOOKARTISTE;
        $this->SOUNDCLOUDARTISTE = $SOUNDCLOUDARTISTE;
        $this->YOUTUBEARTISTE = $YOUTUBEARTISTE;
        $this->SNAPCHATARTISTE = $SNAPCHATARTISTE;
        $this->INSTAGRAMARTISTE = $INSTAGRAMARTISTE;
        $this->PRENOMMANAGER = $PRENOMMANAGER;
        $this->EMAILMANAGER = $EMAILMANAGER;
        $this->IMAGEARTISTE = $IMAGEARTISTE;
        $this->TELMANAGER = $TELMANAGER;
    }

    public function getIDARTISTE()
    {
        return $this->IDARTISTE;
    }

    public function getPSEUDOARTISTE()
    {
        return $this->PSEUDOARTISTE;
    }

    public function getALIASARTISTE()
    {
        return $this->ALIASARTISTE;
    }

    public function getTELARTISTE()
    {
        return $this->TELARTISTE;
    }

    public function getDESCARTISTE()
    {
        return $this->DESCARTISTE;
    }

    public function getBIOARTISTE()
    {
        return $this->BIOARTISTE;
    }

    public function getgenre_IDGENRE()
    {
        return $this->genre_IDGENRE;
    }

    public function getmembre_IDMEMBRE()
    {
        return $this->membre_IDMEMBRE;
    }
    public function getSITEINTERNETARTISTE()
    {
        return $this->SITEINTERNETARTISTE;
    }
    public function getFACEBOOKARTISTE()
    {
        return $this->FACEBOOKARTISTE;
    }
    public function getSOUNDCLOUDARTISTE()
    {
        return $this->SOUNDCLOUDARTISTE;
    }
    public function getYOUTUBEARTISTE()
    {
        return $this->YOUTUBEARTISTE;
    }
    public function getSNAPCHATARTISTE()
    {
        return $this->SNAPCHATARTISTE;
    }
    public function getINSTAGRAMARTISTE()
    {
        return $this->INSTAGRAMARTISTE;
    }
    public function getPRENOMMANAGER()
    {
        return $this->PRENOMMANAGER;
    }
    public function getEMAILMANAGER()
    {
        return $this->EMAILMANAGER;
    }
    public function getIMAGEARTISTE()
    {
        return $this->IMAGEARTISTE;
    }
    public function getTELMANAGER()
    {
        return $this->TELMANAGER;
    }


}