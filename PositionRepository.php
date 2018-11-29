<?php
namespace App\Repositories;

use App\Models\Audit;
use App\Models\Position;


class PositionRepository
{
    protected $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function create($cols)
    {
        //return $this->address->create($attributes);
        $this->position->name = $cols['name'];
        $this->position->save();
        return $this->position;
    }

    public function update($id, array $attributes)
    {
        return $this->position->find($id)->update($attributes);
    }

    public function all($filter, $items_per_page)
    {
        $positions = $this->position->where($filter)->orderBy('name', 'asc');
        return $positions->paginate($items_per_page);
    }
}
