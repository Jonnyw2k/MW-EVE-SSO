<?php

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

/**
 * Based on https://github.com/killmails/oauth2-eve/ and recreated in this project for security reasons
 */
class EveOnlineSSOResourceOwner implements ResourceOwnerInterface
{

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Response from the /characters/ ESI endpoint
     *
     * @var array
     */
    protected $characterInfo;

    /**
     * Creates new resource owner.
     *
     * @param array $response
     * @param array $characterInfo Response from the /characters/ ESI endpoint
     */
    public function __construct(array $response, array $characterInfo)
    {
        $this->response = $response;
        $this->characterInfo = $characterInfo;
    }

    /**
     * Get resource owner id (character id).
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->response['CharacterID'] ?: null;
    }

    /**
     * Get character id. Alias of getId().
     *
     * @return int|null
     */
    public function getCharacterID()
    {
        return $this->getId();
    }

    /**
     * Get resource owner name (character name).
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['CharacterName'] ?: null;
    }

    /**
     * Get character name. Alias of getName().
     *
     * @return string|null
     */
    public function getCharacterName()
    {
        return $this->getName();
    }

    /**
     * Get character owner hash.
     *
     * @return string|null
     */
    public function getCharacterOwnerHash()
    {
        return $this->response['CharacterOwnerHash'];
    }

    /**
     * Get the ID of the Corporation that the Character currently belongs
     *
     * @return int
     */
    public function getCorporationId()
    {
        return $this->characterInfo['alliance_id'];
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
