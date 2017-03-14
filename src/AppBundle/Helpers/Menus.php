<?php
namespace AppBundle\Helpers;

use AppBundle\Entity\Groups;
use AppBundle\Entity\Menus as MenuItem;
use AppBundle\Entity\Pages;
use Symfony\Component\DependencyInjection\Container;

class Menus
{
    /**
     * @var Container
     */
    private $container;

    private $entityManager;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->entityManager = $this->container->get('doctrine')->getManager();
        return $this;
    }

    /**
     * @param integer $parentId
     * @return array
     */
    public function getMenuItems($parentId)
    {
        $menusRepository = $this->entityManager->getRepository('AppBundle:Menus');
        $menuItems =$menusRepository->findByParentId($parentId);
        $return = [];
        foreach ($menuItems as $menuItem) {
            $return[] = [
                'id' => $menuItem->getId(),
                'type' => $menuItem->getType(),
                'text' => $menuItem->getText(),
                'target' => $menuItem->getTarget(),
                'url' => $menuItem->getUrl(),
                'children' => $this->getMenuItems($menuItem->getId()),
            ];
        }
        return $return;
    }

    /**
     * @param array $criteria
     * @return Groups|Pages|Url|null
     */
    public function getPageFromMenu(array $criteria)
    {
        $menusRepository = $this->entityManager->getRepository('AppBundle:Menus');
        $firstItem = $menusRepository->findOneBy($criteria);
        return $this->getItemInformation($firstItem);
    }

    /**
     * @param MenuItem $menuItem
     * @return Groups|Pages|Url|null
     */
    private function getItemInformation(MenuItem $menuItem)
    {
        switch ($menuItem->getType()) {
            case MenuItem::MENUITEM_NO_LINK:
                return null;
                break;
            case MenuItem::MENUITEM_PAGE_ITEM:
                $pagesRepository = $this->entityManager->getRepository('AppBundle:Pages');
                $pages = $pagesRepository->findOneBy(['id' => $menuItem->getItemid()]);
                if (count($pages) > 0) {
                    return $pages[0];
                }
                break;
            case MenuItem::MENUITEM_PAGE_GROUP:
                $groupsRepository = $this->entityManager->getRepository('AppBundle:Groups');
                $groups = $groupsRepository->findOneBy(['id' => $menuItem->getId()]);
                if (count($groups)> 0) {
                    return $groups[0];
                }
                break;
            case MenuItem::MENUITEM_OWN_URL:
                $url = new Url();
                $url->setUrl($menuItem->getUrl());
                return $url;
                break;
        }
        return null;
    }

    /**
     * @param $menuItemId
     * @return string
     */
    public function generateMenuItemUrl($menuItemId)
    {
        $menusRepository = $this->entityManager->getRepository('AppBundle:Menus');
        /**
         * @var MenuItem
         */
        $menuItem = $menusRepository->findOneBy(['id' => $menuItemId]);
        if(count($menuItem) > 0) {
            switch ($menuItem->getType()) {
                case MenuItem::MENUITEM_NO_LINK:
                    return '#';
                    break;
                case MenuItem::MENUITEM_PAGE_ITEM:
                    $pagesRepository = $this->entityManager->getRepository('AppBundle:Pages');
                    $pages = $pagesRepository->findOneBy(['id' => $menuItem->getItemId()]);
                    if (count($pages) > 0) {
                       return '/pagina/' . $pages[0]->getSeo() . '/';
                    }
                    break;
                case MenuItem::MENUITEM_PAGE_GROUP:
                    $groupsRepository = $this->entityManager->getRepository('AppBundle:Groups');
                    $groups = $groupsRepository->findOneBy(['id' => $menuItem->getItemId()]);
                    if (count($groups) > 0) {
                        return '/groep/' . $groups[0]->getSlug() . '/';
                    }
                    break;
                case MenuItem::MENUITEM_OWN_URL:
                    $url = $menuItem->getUrl();
                    if (trim($url) != '' && !strpos($url, 'http://') && !strpos($url, 'https://')) {
                        $url = 'http://' . $url;
                    }
                    return $url;
                    break;
            }
        }
        return '#';
    }
}