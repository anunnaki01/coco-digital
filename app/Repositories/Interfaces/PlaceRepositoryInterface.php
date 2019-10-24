<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 23/10/19
 * Time: 08:34 PM
 */

namespace App\Repositories\Interfaces;

use App\Models\Place;

/**
 * Interface PlaceRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface PlaceRepositoryInterface
{

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param array $placeData
     * @return Place
     */
    public function store(array $placeData): Place;

}