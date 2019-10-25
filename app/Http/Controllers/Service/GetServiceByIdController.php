<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class GetByIdController
 * @package App\Http\Controllers\Place
 */
class GetServiceByIdController extends Controller
{
    /**
     * @var PlaceRepositoryInterface
     */
    protected $serviceRepository;

    /**
     * GetServiceByIdController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->middleware('auth');
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $service = $this->serviceRepository->getById($id);

        if (empty($service)) {
            return response()->json(['message' => "Service not found"], 404);
        }

        return response()->json(['message' => 'Service found', 'service' => $service], 200);
    }
}
