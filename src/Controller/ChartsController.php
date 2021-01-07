<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Chart;
use App\Entity\Sing;
use App\Entity\Track;
use App\Entity\TracksChart;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use APP\Repository\ChartRepository;


class ChartsController {
    /**
    * @Route("/api/chart_tracks", methods={"GET"}, name="my_api_custom_data")
    */
    public function getTrackCharts(Request $request, EntityManagerInterface $entityManager)
    {
        $date = $request->get('date');
        $idPlatform = $request->get('id_platform');
        $coutnry = $request->get('id_country');
        $chart = $entityManager->getRepository(Chart::class)->findOneBy([
                    'countryId' => $coutnry,
                    'platformMusicId' => $idPlatform,
                ]);
        $idChart = $chart->getId();
        $tracks_chart = $entityManager->getRepository(TracksChart::class)->findBy([
            'chartId' => $idChart,
            'publication_date' => $date,
        ]);
        $output = array();
        foreach($tracks_chart as $track)
        {
            $trackInfo = $entityManager->getRepository(Track::class)->findOneBy([
                'id' => $track->getTrackId(),
            ]);
            $sing = $entityManager->getRepository(Sing::class)->findOneBy([
                'trackId' => $trackInfo->getId(),
            ]);
            $artistSing = $entityManager->getRepository(Artist::class)->findOneBy([
                'id' => $sing->getArtistId(),
            ]);


            array_push($output,["position"=>$track->getPosition(),
                                "title" => $trackInfo->getTitle(),
                                "artist" => $artistSing->getName(),
                                "cover" => $trackInfo->getCover(),

            ]);
        }


        $response = new JsonResponse();
        $response->setData($output);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
    * @Route("/api/date_charts", methods={"GET"}, name="get_date")
    */
    public function getDateCharts(Request $request, EntityManagerInterface $entityManager)
    {
        $trackInfo = $entityManager->getRepository(TracksChart::class)->getDateCharts();
        $response = new JsonResponse();
        $response->setData($trackInfo);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

}