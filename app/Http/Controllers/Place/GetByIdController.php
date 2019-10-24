<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PlaceRepositoryInterface;

class GetByIdController extends Controller
{
    /**
     * @var PlaceRepositoryInterface
     */
    protected $placeRepository;

    /**
     * RegisterController constructor.
     * @param PlaceRepositoryInterface $placeRepository
     */
    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function __invoke(int $id)
    {
        $place = $this->placeRepository->getById($id);

        if (empty($place)) {
            response()->json(['message' => "Place not found"], 404);
        }

        return response()->json(['message' => 'Place found', 'data' => $place], 200);
    }
}
