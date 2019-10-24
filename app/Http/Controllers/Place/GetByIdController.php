<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class GetByIdController
 * @package App\Http\Controllers\Place
 */
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

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $place = $this->placeRepository->getById($id);

        if (empty($place)) {
            return response()->json(['message' => "Place not found"], 404);
        }

        return response()->json(['message' => 'Place found', 'data' => $place], 200);
    }
}
