<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use App\Entity\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room")
 */
class RoomController extends AbstractController
{
    /**
     * @Route("/", name="room_index", methods={"GET"})
     */
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('room/index.html.twig', [
            'rooms' => $roomRepository->findAll(),
        ]);
    }

    // /**
    //  * @Route("/new", name="room_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request, Owner $owner): Response
    // {

    //     $room = new Room();
    //     $form = $this->createForm(RoomType::class, $room);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($room);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('room_index', $owner->id, [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('room/new.html.twig', [
    //         'room' => $room,
    //         'form' => $form->createView(),
    //     ]);
    // }

     /**
     * @Route("/createroomfrom/{id}", name="new_room_of", methods={"GET","POST"})
     */
    public function create(Request $request, Owner $owner): Response
    {

        $room = new Room();
        $room->setOwner($owner); //(ligne rajoutée pour créer dans owner)
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('owner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('room/create.html.twig', [
            'owner' => $owner, //(ligne rajoutée pour créer dans owner)
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="room_show", methods={"GET"})
     */
    public function show(Room $room): Response
    {
        return $this->render('room/show.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Room $room): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('room/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_delete", methods={"POST"})
     */
    public function delete(Request $request, Room $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room_index', [], Response::HTTP_SEE_OTHER);
    }
}
