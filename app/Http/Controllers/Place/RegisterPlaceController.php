<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Place
 */
class RegisterPlaceController extends Controller
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
        $this->middleware('auth');
        $this->placeRepository = $placeRepository;
    }

    /**
     * @param PlaceRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function __invoke(PlaceRequest $request): JsonResponse
    {
        try {
            $place = $this->placeRepository->store($request->validated());
            return response()->json(['message' => 'profesional registrado con exito', 'place' => $place], 201);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
}
