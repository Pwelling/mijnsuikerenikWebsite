<?php
namespace AppBundle\Helpers;

class Url
{
    /**
     * @var string
     */
    private $url = '';

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}