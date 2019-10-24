<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class ListController
 * @package App\Http\Controllers\Place
 */
class ListController extends Controller
{
    /**
     * @var PlaceRepositoryInterface
     */
    protected $placeRepository;

    /**
     * @var CompanyRepositoryInterface
     */
    protected $companyRepository;

    /**
     * ListController constructor.
     * @param PlaceRepositoryInterface $placeRepository
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        PlaceRepositoryInterface $placeRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->middleware('auth');
        $this->placeRepository = $placeRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('places.list')
            ->with('companies', $this->companyRepository->getAll());
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $places = $this->placeRepository->getAll();

        if (empty($places)) {
            return response()->json(['message' => 'No hay registros'], 404);
        }

        $placesReturn = [];

        array_walk($places, function ($place, $key) use (&$placesReturn) {
            $placesReturn[$key]['id'] = $place['id'];
            $placesReturn[$key]['name'] = $place['name'];
            $placesReturn[$key]['is_active'] = (bool)$place['is_active'];
            $placesReturn[$key]['company'] = $place['company']['name'];
        });

        return response()->json(['message' => 'registros encontrados', "places" => $placesReturn], 200);
    }

}
