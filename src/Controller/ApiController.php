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
                'form_params' => [
                    'options' => [
                        'login' => 'depauto',
                        'pass' => 'depauto',
                        'datatyp' => 'html',
                        'storage' => $data['storage']
                    ],
                ],

                'curl'    => [
                    CURLOPT_SSL_VERIFYPEER => false,
                ],
            ];

            if($data['articul']) {
                $params['form_params']['data']['articul'] = $data['articul'];
            }

            if($data['brand']) {
                $params['form_params']['data']['brand'] = $data['brand'];
            }


            $api = new AutoApi();
            $result = $api->getItems('POST', 'https://api.auto-sputnik.ru/search_result.php', $params);

            return $this->render('api/index.html.twig', [
                'form' => $form->createView(),
                'result' => $result,
            ]);

        }

        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
