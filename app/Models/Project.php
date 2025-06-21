<?php

namespace App\Models;

class Project
{
    private $id;
    private $title;
    private $category;
    private $creator;
    private $creatorID;
    private $requestedPeople;
    private $place;
    private $startDate;
    private $endDate;
    private $expireDate;
    private $associationName;
    private $sumDescription;
    private $fullDescription;
    private $requirements;
    private $travelConditions;


    public function __construct($id, $title, $category, $creator, $creatorID, $requestedPeople, $place, $startDate, $endDate, $expireDate, $associationName, $sumDescription, $fullDescription, $requirements, $travelConditions)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->creator = $creator;
        $this->creatorID = $creatorID;
        $this->requestedPeople = $requestedPeople;
        $this->place = $place;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->expireDate = $expireDate;
        $this->associationName = $associationName;
        $this->sumDescription = $sumDescription;
        $this->fullDescription = $fullDescription;
        $this->requirements = $requirements;
        $this->travelConditions = $travelConditions;
    }

    // Getters

    function getID() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getCategory() {
        return $this->category;
    }

    function getCreator() {
        return $this->creator;
    }

    function getCreatorID(){
        return $this->creatorID;
    }

    function getRequestedPeople() {
        return $this->requestedPeople;
    }

    function getPlace() {
        return $this->place;
    }

    function getStartDate() {
        return $this->startDate;
    }

    function getEndDate() {
        return $this->endDate;
    }

    function getExpireDate() {
        return $this->expireDate;
    }

    function getAssociationName() {
        return $this->associationName;
    }

    function getSumDescription() {
        return $this->sumDescription;
    }

    function getFullDescription() {
        return $this->fullDescription;
    }

    function getRequirements() {
        return $this->requirements;
    }

    function getTravelConditions() {
        return $this->travelConditions;
    }

    // Setters

    function setID($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->id = $title;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setCreator($creator) {
        $this->creator = $creator;
    }

    function setCreatorID($creatorID) {
        $this->creatorID = $creatorID;
    }

    function setRequestedPeople($requestedPeople) {
        $this->requestedPeople = $requestedPeople;
    }

    function setPlace($place) {
        $this->place = $place;
    }

    function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    function setExpireDate($expireDate) {
        $this->expireDate = $expireDate;
    }

    function setAssociationName($associationName) {
        $this->associationName = $associationName;
    }

    function setSumDescription($sumDescription) {
        $this->sumDescription = $sumDescription;
    }

    function setFullDescription($fullDescription) {
        $this->fullDescription = $fullDescription;
    }

    function setRequirements($requirements) {
        $this->requirements = $requirements;
    }

    function setTravelConditions($travelConditions) {
        $this->travelConditions = $travelConditions;
    }
}

