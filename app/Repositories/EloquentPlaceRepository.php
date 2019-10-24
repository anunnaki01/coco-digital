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
        $places = $this->place->with('company')->get();

        return empty($places) ? [] : $places->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $place = $this->place->with('company')->find($id);

        return empty($place) ? [] : $place->toArray();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->place->where('id', $id)->update($data);
    }

    /**
     * @param array $placeData
     * @return Place
     */
    public function store(array $placeData): Place
    {
        $place = $this->place->create($placeData);

        return $this->place->with('company')->find($place->id);
    }
}