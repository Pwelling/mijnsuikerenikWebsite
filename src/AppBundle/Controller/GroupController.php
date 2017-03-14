<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GroupController extends Controller
{
    public function indexAction($slug)
    {
        $group = $this->get('doctrine')->getRepository('AppBundle:Groups')->findOneBy(['slug' => $slug]);
        if (count($group) == 0) {
            return $this->render('AppBundle:Exceptions:404.html.twig');
        }
        return $this->render('AppBundle:Group:index.html.twig', array(
            'group' => $group[0],
        ));
    }

}
