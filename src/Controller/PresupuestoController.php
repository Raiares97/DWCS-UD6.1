<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PresupuestoRepository;
use App\Entity\Presupuesto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/api", "api_presupuesto_db")]
class PresupuestoController extends AbstractController
{

    #[Route('/presupuestos', name: 'app_presupuesto', methods: ['GET'])]
    public function index(PresupuestoRepository $PresupuestoRepository): JsonResponse
    {
        $presupuestos = $PresupuestoRepository->findAll();
        return $this->json($presupuestos);
    }

    #[Route("/presupuestos/{id}", "getPresupuesto", methods: ["GET"])]
    public function getPresupuesto(Presupuesto $id): JsonResponse
    {
        return $this->json($id);
    }

    #[Route("/borrar/{id}", "delete_presupuesto", methods: ["DELETE"])]
    public function deletePresupuesto(Presupuesto $presupuesto, PresupuestoRepository $presupuestoRepository)
    {
        $presupuestoRepository->remove($presupuesto, true);
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }


    #[Route("/create", "createPresupuesto", methods: ["POST"])]
    public function crearPresupuesto(Request $request, PresupuestoRepository $PresupuestoRepository): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $presupuesto = new Presupuesto();
        $presupuesto->setId($requestBody("Id"));
        $presupuesto->setNombre($requestBody("Nombre"));
        $presupuesto->setTotal($requestBody("Total"));

        $PresupuestoRepository->save($presupuesto, true);
        return $this->json($presupuesto, status: Response::HTTP_CREATED);
    }

    #[Route("/update/{id}", "update_presupuesto", methods: ["PATCH", "PUT"])]
    public function update_presupuesto(Presupuesto $presupuesto, Request $request, PresupuestoOptionsResolver $PresupuestOptionsResolver, ValidatorInterface $validator, EntityManagerInterface $em)
    {
        try {
            $isPatchMethod = $request->getMethod() === "PUT";
            $requestBody = json_decode($request->getContent(), true);


            $fields = $PresupuestOptionsResolver
                ->configureId($isPatchMethod)
                ->configureNombre($isPatchMethod)
                ->configureTotal($isPatchMethod)
                ->resolve($requestBody);

            foreach ($fields as $field => $value) {
                switch ($field) {
                    case "Id":
                        $presupuesto->setId($value);
                        break;
                    case "Nombre":
                        $presupuesto->setNombre($value);
                        break;
                    case "Total":
                        $presupuesto->setTotal($value);
                }
            }

            $errors = $validator->validate($presupuesto);
            if (count($errors) > 0) {
                throw new InvalidArgumentException((string) $errors);
            }

            $em->flush();
            // ...

        } catch (Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
