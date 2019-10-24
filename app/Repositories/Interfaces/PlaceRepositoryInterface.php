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
     * @return array
     */
    public function getById(): array;

    /**
     * @param array $placeData
     * @return Place
     */
    public function store(array $placeData): Place;

}