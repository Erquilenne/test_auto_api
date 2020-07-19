<?php

namespace App\Controller;

use App\Form\AutoApiType;
use App\miniSDK\AutoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(AutoApiType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $params = [
                'options' => [
                    'login' => 'depauto',
                    'pass' => 'pass',
                    'datatyp' => 'html',
                    'storage' => $data['storage']
                ]
            ];

            if($data['articul']) {
                $params['data']['articul'] = $data['articul'];
            }

            if($data['brand']) {
                $params['data']['brand'] = $data['brand'];
            }


            $api = new AutoApi();
            $result = $api->getItems('POST', 'https://api.auto-sputnik.ru/search_result.php', $params);

        }

        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
