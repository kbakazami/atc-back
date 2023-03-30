<?php

namespace App\Model;

class OfficeDetailItem {

    private $id;
    private $price;
    private $surface;
    private $images;
    private $description;
    private $name;
    private $isFiber;
    private $isComputer;
    private $isScreen;
    private $isMouseKeyboard;
    private $isKitchen;

    private $addressId;
    private $country;
    private $city;
    private $zipCode;
    private $street;

    private $reviews;
    private $reviewAverage;

    private $ownerFirstName;
    private $ownerLastName;

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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @param mixed $surface
     */
    public function setSurface($surface): void
    {
        $this->surface = $surface;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIsFiber()
    {
        return $this->isFiber;
    }

    /**
     * @param mixed $isFiber
     */
    public function setIsFiber($isFiber): void
    {
        $this->isFiber = $isFiber;
    }

    /**
     * @return mixed
     */
    public function getIsComputer()
    {
        return $this->isComputer;
    }

    /**
     * @param mixed $isComputer
     */
    public function setIsComputer($isComputer): void
    {
        $this->isComputer = $isComputer;
    }

    /**
     * @return mixed
     */
    public function getIsScreen()
    {
        return $this->isScreen;
    }

    /**
     * @param mixed $isScreen
     */
    public function setIsScreen($isScreen): void
    {
        $this->isScreen = $isScreen;
    }

    /**
     * @return mixed
     */
    public function getIsMouseKeyboard()
    {
        return $this->isMouseKeyboard;
    }

    /**
     * @param mixed $isMouseKeyboard
     */
    public function setIsMouseKeyboard($isMouseKeyboard): void
    {
        $this->isMouseKeyboard = $isMouseKeyboard;
    }

    /**
     * @return mixed
     */
    public function getIsKitchen()
    {
        return $this->isKitchen;
    }

    /**
     * @param mixed $isKitchen
     */
    public function setIsKitchen($isKitchen): void
    {
        $this->isKitchen = $isKitchen;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @param mixed $addressId
     */
    public function setAddressId($addressId): void
    {
        $this->addressId = $addressId;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews): void
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getReviewAverage()
    {
        return $this->reviewAverage;
    }

    /**
     * @param mixed $reviewAverage
     */
    public function setReviewAverage($reviewAverage): void
    {
        $this->reviewAverage = $reviewAverage;
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

}