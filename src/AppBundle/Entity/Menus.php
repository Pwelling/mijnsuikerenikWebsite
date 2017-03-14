<?php

namespace AppBundle\Entity;

class Menus
{
    const MENUITEM_NO_LINK = 0;
    const MENUITEM_PAGE_GROUP = 1;
    const MENUITEM_PAGE_ITEM = 2;
    const MENUITEM_OWN_URL = 3;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $itemid;

    /**
     * @var integer
     */
    private $parentid;

    /**
     * @var string
     */
    private $text;

    /**
     * @var boolean
     */
    private $target = '0';

    /**
     * @var string
     */
    private $url;

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $updatedAt = '0000-00-00 00:00:00';

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $type
     * @return Menus
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param integer $itemid
     * @return Menus
     */
    public function setItemid($itemid)
    {
        $this->itemid = $itemid;
        return $this;
    }

    /**
     * @return integer
     */
    public function getItemid()
    {
        return $this->itemid;
    }

    /**
     * @param integer $parentid
     * @return Menus
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
        return $this;
    }

    /**
     * @return integer
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * @param string $text
     * @return Menus
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param boolean $target
     * @return Menus
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $url
     * @return Menus
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param \DateTime $createdAt
     * @return Menus
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Menus
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
