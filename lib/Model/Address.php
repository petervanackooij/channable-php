<?php

namespace Channable\Model;

class Address
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $street;

    /**
     * @var int
     */
    private $houseNumber;

    /**
     * @var string
     */
    private $houseNumberExtension;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    public function __construct(
        string $firstName,
        string $middleName,
        string $lastName,
        string $company,
        string $email,
        string $countryCode,
        string $city,
        string $zipCode,
        string $street,
        int $houseNumber,
        string $houseNumberExtension,
        string $region,
        string $address1,
        string $address2
    ) {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->company = $company;
        $this->email = $email;
        $this->countryCode = $countryCode;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->houseNumberExtension = $houseNumberExtension;
        $this->region = $region;
        $this->address1 = $address1;
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return int
     */
    public function getHouseNumber(): int
    {
        return $this->houseNumber;
    }

    /**
     * @return string
     */
    public function getHouseNumberExtension(): string
    {
        return $this->houseNumberExtension;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }
}
