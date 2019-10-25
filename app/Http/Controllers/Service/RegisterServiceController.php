<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterServiceController
 * @package App\Http\Controllers\Place
 */
class RegisterServiceController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    protected $serviceRepository;

    /**
     * RegisterServiceController constructor.
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
            $place = $this->serviceRepository->store($request->validated());
            return response()->json(['message' => 'servicio registrado con exito', 'service' => $place], 201);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
}
