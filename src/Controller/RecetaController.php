<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Receta;

/**
 * @Route("/api", name="api_")
 */

class RecetaController extends AbstractController
{
    /**
    * @Route("/receta", name="receta_index", methods={"GET"})
    */
    public function index(ManagerRegistry $doctrine): Response
    {
        $recetas = $doctrine
            ->getRepository(Receta::class)
            ->findAll();
   
        $data = [];
   
        foreach ($recetas as $receta) {
           $data[] = [
               'id' => $receta->getId(),
               'nombreReceta' => $receta->getNombreReceta(),
               'ingredientes' => $receta->getIngredientes(),
               'procedimientos' => $receta->getProcedimientos(),
               'autor' => $receta->getAutor(),
               'imagen' => $receta->getImagen()
           ];
        }
   
   
        return $this->json($data);
    }
  
   
    /**
     * @Route("/receta", name="receta_new", methods={"POST"})
     */
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
   
        $receta = new Receta();
        $receta->setNombreReceta($request->request->get('nombreReceta'));
        $receta->setIngredientes($request->request->get('ingredientes'));
        $receta->setProcedimientos($request->request->get('procedimientos'));
        $receta->setAutor($request->request->get('autor'));
        $receta->setImagen($request->request->get('imagen'));
   
        $entityManager->persist($receta);
        $entityManager->flush();
   
        return $this->json('Created new receta successfully with id ' . $receta->getId());
    }
   
    /**
     * @Route("/receta/{id}", name="receta_show", methods={"GET"})
     */
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $receta = $doctrine->getRepository(Receta::class)->find($id);
   
        if (!$receta) {
   
            return $this->json('No receta found for id' . $id, 404);
        }
   
        $data =  [
            'id' => $receta->getId(),
            'nombreReceta' => $receta->getNombreReceta(),
            'ingredientes' => $receta->getIngredientes(),
            'procedimientos' => $receta->getProcedimientos(),
            'autor' => $receta->getAutor(),
            'imagen' => $receta->getImagen()
        ];
           
        return $this->json($data);
    }
   
    /**
     * @Route("/receta/{id}", name="receta_edit", methods={"PUT", "PATCH"})
     */
    public function edit(ManagerRegistry $doctrine, Request $request, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $receta = $entityManager->getRepository(Receta::class)->find($id);
   
        if (!$receta) {
            return $this->json('No receta found for id' . $id, 404);
        }
         
        $content = json_decode($request->getContent());
        $receta->setNombreReceta($content->nombreReceta);
        $receta->setIngredientes($content->ingredientes);
        $receta->setProcedimientos($content->procedimientos);
        $receta->setAutor($content->autor);
        $receta->setImagen($content->imagen);

        $entityManager->flush();
   
        $data =  [
            'id' => $receta->getId(),
            'nombreReceta' => $receta->getNombreReceta(),
            'ingredientes' => $receta->getIngredientes(),
            'procedimientos' => $receta->getProcedimientos(),
            'autor' => $receta->getAutor(),
            'imagen' => $receta->getImagen()
        ];
           
        return $this->json($data);
    }
   
    /**
     * @Route("/receta/{id}", name="receta_delete", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $receta = $entityManager->getRepository(Receta::class)->find($id);
   
        if (!$receta) {
            return $this->json('No receta found for id' . $id, 404);
        }
   
        $entityManager->remove($receta);
        $entityManager->flush();
   
        return $this->json('Deleted a receta successfully with id ' . $id);
    }
}
