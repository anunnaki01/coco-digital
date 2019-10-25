<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class ListController
 * @package App\Http\Controllers\Place
 */
class ListServicesController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    protected $serviceRepository;

    /**
     * @var PlaceRepositoryInterface
     */
    protected $placeRepository;

    /**
     * ListServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     * @param PlaceRepositoryInterface $placeRepository
     */
    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        PlaceRepositoryInterface $placeRepository
    ) {
        $this->middleware('auth');
        $this->serviceRepository = $serviceRepository;
        $this->placeRepository = $placeRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('services.list')
            ->with('places', $this->placeRepository->getAll());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $services = $this->serviceRepository->getAll();

        if (empty($services)) {
            return response()->json(['message' => 'No hay registros'], 404);
        }

        $servicesReturn = [];

        array_walk($services, function ($service, $key) use (&$servicesReturn) {
            $servicesReturn[$key]['id'] = $service['id'];
            $servicesReturn[$key]['name'] = $service['name'];
            $servicesReturn[$key]['is_enabled'] = (bool)$service['is_enabled'];
            $servicesReturn[$key]['time'] = $service['time'];
            $servicesReturn[$key]['preparation'] = $service['preparation'];
            $servicesReturn[$key]['place'] = $service['place']['name'];
        });


        return response()->json(['message' => 'registros encontrados', "services" => $servicesReturn], 200);
    }

}
