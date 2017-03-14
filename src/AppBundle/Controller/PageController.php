<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $homePage = $this->get('menu_helper')->getPageFromMenu(['parentid' => 0]);
        if (is_null($homePage)) {
            return $this->render('AppBundle:Exceptions:404.html.twig');
        }
        return $this->render('AppBundle:Page:index.html.twig', array(
            'page' => $homePage,
        ));
    }

    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pageAction($slug)
    {
        $page = $this->get('doctrine')->getRepository('AppBundle:Pages')->findOneBy(['seo' => $slug]);
        if (count($page) == 0) {
            return $this->render('AppBundle:Exceptions:404.html.twig');
        }
        return $this->render('AppBundle:Page:index.html.twig', array(
            'page' => $page[0],
        ));
    }
}
