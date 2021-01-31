<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;

abstract class Repository
{
    protected $query;

    /**
     * Constructor
     *
     * Repository constructor.
     * @param null $instance
     */
    public function __construct($instance = null)
    {
        $this->query = $instance->newQuery();
    }

    /**
     * Get all records (objects)
     *
     * @return array
     */
    public function getAll()
    {
        return $this->query->get()->all();
    }

    /**
     * Get object by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->query->find($id);
    }

    /**
     * Create record
     *
     * @param array $input
     * @return mixed
     */
    public function create(array $input)
    {
        return $this->query->create($input);
    }

    /**
     * Update record
     *
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input)
    {
        return $this->query->find($id)->update($input);
    }

    /**
     * Delete record
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $rs = $this->query->find($id)->delete();

        $xml = new Xmls();
        $xml->resetFieldNo();

        return $rs;
    }

    /**
     * This function is to get page of record cancel edited
     *
     * @param $id
     * @param $perPage
     */
    public function getOlderPage($id, $perPage)
    {
        $data = $this->query->pluck('id')->toArray();
        $index = array_search($id, $data) + 1;
        $page = intval($index / $perPage);
        if ($index % $perPage != 0) {
            $page += 1;
        }
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
    }
}