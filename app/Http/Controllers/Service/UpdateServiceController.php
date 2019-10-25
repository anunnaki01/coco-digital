<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Http\Requests\ServiceRequest;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class UpdateServiceController
 * @package App\Http\Controllers\Service
 */
class UpdateServiceController extends Controller
{
    /**
     * @var PlaceRepositoryInterface
     */
    protected $serviceRepository;

    /**
     * UpdateServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->middleware('auth');
        $this->serviceRepository = $serviceRepository;
    }


    /**
     * @param ServiceRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(ServiceRequest $request): JsonResponse
    {
        try {

            $data = $request->validated();
            unset($data['id']);

            $updated = $this->serviceRepository->update($request->get('id'), $data);

            if (!$updated) {
                return response()->json(['message' => 'Error al actualizar el servicio'], 412);
            }

            return response()->json(['message' => 'servico actualizado con éxito'], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
}
