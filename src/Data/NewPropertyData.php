<?php

namespace App\Data;

class NewPropertyData
{

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $shortDescription;

    /**
     * @var string
     */
    public $longDescription;    

    /**
     * @var int
     */
    public $capacity;

    /**
     * @var int
     */
    public $nbBathroom;

    /**
     * @var int
     */
    public $nbWc;


    /**
     * @var boolean
     */
    public $isEnable;

    /**
     * @var datetime
     */
    public $createdDate;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $photo;

    /**
     * @var File
     */
    public $photoFile;

    /**
     * @var Address
     */
    public $address;    

    /**
     * @var Country
     */
    public $country;

    /**
     * @var City
     */
    public $city;
}
