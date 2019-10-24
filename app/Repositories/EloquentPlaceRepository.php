<?php

namespace App\Repositories;


use App\Models\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;

/**
 * Class EloquentPlaceRepository
 * @package App\Repositories
 */
class EloquentPlaceRepository implements PlaceRepositoryInterface
{
    /**
     * @var Place
     */
    protected $place;

    /**
     * EloquentPlaceRepository constructor.
     * @param Place $place
     */
    public function __construct(Place $place)
    {
        $this->place = $place;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @return array
     */
    public function getById(): array
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param array $placeData
     * @return Place
     */
    public function store(array $placeData): Place
    {
        return $this->place->create($placeData);
    }
}