<?php

namespace App\Model;

class ReservationItem {

    private $id;
    private $date;
    private $time_slot;

    private $userFirstName;
    private $userLastName;
    private $userEmail;

    private $ownerFirstName;
    private $ownerLastName;
    private $ownerEmail;
    private $officeName;
    private $officePrice;
    private $officeCountry;
    private $officeCity;
    private $officeZipCode;
    private $officeStreet;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTimeSlot()
    {
        return $this->time_slot;
    }

    /**
     * @param mixed $time_slot
     */
    public function setTimeSlot($time_slot): void
    {
        $this->time_slot = $time_slot;
    }

    /**
     * @return mixed
     */
    public function getOwnerFirstName()
    {
        return $this->ownerFirstName;
    }

    /**
     * @param mixed $ownerFirstName
     */
    public function setOwnerFirstName($ownerFirstName): void
    {
        $this->ownerFirstName = $ownerFirstName;
    }

    /**
     * @return mixed
     */
    public function getOwnerLastName()
    {
        return $this->ownerLastName;
    }

    /**
     * @param mixed $ownerLastName
     */
    public function setOwnerLastName($ownerLastName): void
    {
        $this->ownerLastName = $ownerLastName;
    }

    /**
     * @return mixed
     */
    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    /**
     * @param mixed $ownerEmail
     */
    public function setOwnerEmail($ownerEmail): void
    {
        $this->ownerEmail = $ownerEmail;
    }

    /**
     * @return mixed
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    /**
     * @param mixed $userFirstName
     */
    public function setUserFirstName($userFirstName): void
    {
        $this->userFirstName = $userFirstName;
    }

    /**
     * @return mixed
     */
    public function getUserLastName()
    {
        return $this->userLastName;
    }

    /**
     * @param mixed $userLastName
     */
    public function setUserLastName($userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @return mixed
     */
    public function getOfficeName()
    {
        return $this->officeName;
    }

    /**
     * @param mixed $officeName
     */
    public function setOfficeName($officeName): void
    {
        $this->officeName = $officeName;
    }

    /**
     * @return mixed
     */
    public function getOfficePrice()
    {
        return $this->officePrice;
    }

    /**
     * @param mixed $officePrice
     */
    public function setOfficePrice($officePrice): void
    {
        $this->officePrice = $officePrice;
    }

    /**
     * @return mixed
     */
    public function getOfficeCountry()
    {
        return $this->officeCountry;
    }

    /**
     * @param mixed $officeCountry
     */
    public function setOfficeCountry($officeCountry): void
    {
        $this->officeCountry = $officeCountry;
    }

    /**
     * @return mixed
     */
    public function getOfficeCity()
    {
        return $this->officeCity;
    }

    /**
     * @param mixed $officeCity
     */
    public function setOfficeCity($officeCity): void
    {
        $this->officeCity = $officeCity;
    }

    /**
     * @return mixed
     */
    public function getOfficeZipCode()
    {
        return $this->officeZipCode;
    }

    /**
     * @param mixed $officeZipCode
     */
    public function setOfficeZipCode($officeZipCode): void
    {
        $this->officeZipCode = $officeZipCode;
    }

    /**
     * @return mixed
     */
    public function getOfficeStreet()
    {
        return $this->officeStreet;
    }

    /**
     * @param mixed $officeStreet
     */
    public function setOfficeStreet($officeStreet): void
    {
        $this->officeStreet = $officeStreet;
    }


}