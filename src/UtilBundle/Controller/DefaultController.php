<?php

namespace UtilBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('UtilBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     * @Route("/ajax_default", name="ajax_default")
     */
    public function getAjaxDefaultAction(Request $request) {
        $value = strtoupper($request->get('term'));
        //$value = $request->get('term');
        $class = $request->get('class');
        $property = $request->get('property');
        $searchMethod = $request->get('search_method');
        $em= $this->getDoctrine()->getManagerForClass($class);

        $entities = $em->getRepository($class)->$searchMethod($value);

        $json = array();

        if (!count($entities)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {

            foreach ($entities as $entity) {
                $json[] = array(
                    'id' => $entity['id'],
                    //'label' => $entity[$property],
                    'value' => $entity[$property]
                );
            }
        }

        $response = new Response();
        $response->setContent(json_encode($json));

        return $response;
    }
    
    
    /**
     * @Route("/autocomplete_extraParams", name="autocomplete_extraParams")
     * 
     * Permite la recepcion de parametros extras, para ser utilizados en el repositorio
     */
    public function getAutocompleteExtraParams(Request $request) {
        $value = strtoupper($request->get('term'));
        //$value = $request->get('term');
        $class = $request->get('class');
        $property = $request->get('property');
        $searchMethod = $request->get('search_method');
        $extraParams = $request->get('extraParams');
        $em= $this->getDoctrine()->getManagerForClass($class);

       
        $entities = $extraParams?$em->getRepository($class)->$searchMethod($value,$extraParams): $em->getRepository($class)->$searchMethod($value);

        $json = array();

        if (!count($entities)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {

            foreach ($entities as $entity) {
                $json[] = array(
                    'id' => $entity['id'],
                    //'label' => $entity[$property],
                    'value' => $entity[$property]
                );
            }
        }

        $response = new Response();
        $response->setContent(json_encode($json));

        return $response;
    }

  

}
