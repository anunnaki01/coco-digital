<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class UpdateController
 * @package App\Http\Controllers\Place
 */
class UpdatePlaceController extends Controller
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
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(PlaceRequest $request): JsonResponse
    {
        try {

            $data = $request->validated();
            unset($data['id']);

            $updated= $this->placeRepository->update( $request->get('id'), $data);

            if(!$updated){
                return response()->json(['message' => 'Error al actualizar el profesional'], 412);
            }

            return response()->json(['message' => 'profesional actualizado con éxito'], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


}
