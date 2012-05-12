<?php

class Facebook_Api extends Facebook_Api_Base
{
    /**
     * Returns user's profile metadata
     *
     * @param void
     * @return array
     */

    public function getProfile()
    {
        return $this->apiCall('/me');
    }
}