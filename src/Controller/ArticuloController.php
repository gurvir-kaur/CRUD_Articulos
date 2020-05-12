<?php

namespace App\Controller;

use App\Entity\Articulos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticuloController extends AbstractController
{
    /**
     * @Route("/articulo", name="articulo")
     */
    public function index()
    {
        /*return $this->render('articulo/index.html.twig', [
            'controller_name' => 'ArticuloController',
        ]);*/

        return $this->mostrar_articulo();
    }

    /**
     * @Route ("add_new_articulo", name="add_new_articulo")
     *
     */
    public function add_new_articulo()
    {
        $action = $this->generateUrl('add_new_articulo');
        return $this->render('articulo/index.html.twig', ['action' => $action]);
    }

    /**
     * @Route ("add_articulo", name="add_articulo")
     *
     */
    public function add_articulo(Request $request)
    {

        $titulo = $request->request->get('titulo');
        $contenido = $request->request->get('contenido');
        $fecha_de_creacion = $request->request->get('fecha_de_creacion');

        // creates an object of product and initializes some data for this example
        $articulo = new Articulos();
        $articulo-> setTitulo($titulo);
        $articulo->setContenido($contenido);
        $articulo->setFechaDeCreacion($fecha_de_creacion);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($articulo);
        $entityManager->flush();


        return $this->render('articulo/added.html.twig');
    }

    /**
     * @Route ("mostrar_articulo", name="mostrar_articulo")
     */
    public function mostrar_articulo()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $respository = $entityManager->getRepository(Articulos::class);
        $articulos = $respository->findAll();
        return $this->render('articulo/index.html.twig',
            [
                'articulos' => $articulos,
            ]
        );
    }


    /**
     * @Route ("delete_articulo/{id}", name="delete_articulo")
     */
    public function delete_articulo($id)
    {
        $articulo = $this->getDoctrine()->getRepository(Articulos::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($articulo);
        $entityManager->flush();

        return $this->render('articulo/deleted.html.twig');
    }

    /**
     * @Route ("modify_articulo/{id}", name="modify_articulo")
     */
    public function modify_articulo($id)
    {

        $articulo = $this->getDoctrine()->getRepository(Articulos::class)->find($id);
        return $this->render('articulo/modify.html.twig',
            [
                'articulo' => $articulo,
            ]
        );
    }

    /**
     * @Route ("modified_articulo/{id}", name="modified_articulo")
     */
    public function modified_articulo(Request $request, $id)
    {

        $articulo = $this->getDoctrine()->getRepository(Articulos::class)->find($id);

        $titulo = $request->request->get('titulo');
        $contenido = $request->request->get('contenido');
        //$fecha_de_creacion = $request->request->get('fecha_de_creacion');

        $articulo->setTitulo($titulo);
        $articulo->setContenido($contenido);
        $articulo->setFechaDeCreacion('20170101');

        $entityManager = $this->getDoctrine()->getManager();
        //$entityManager->persist($item);
        $entityManager->flush();

        //this return shows the new item added
        return $this->render('articulo/index.html.twig');

    }
}
