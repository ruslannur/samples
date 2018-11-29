<?php
namespace App\Services;

use App\Errors;
//use App\Post;
//use App\Repositories\PostRepository;
use App\Repositories\AddressRepository;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;
use Fomvasss\Dadata\Facades\DadataSuggest;
use Fomvasss\Dadata\Facades\DadataClean;

class PositionService
{
    protected $position_rep;

    public function __construct(PositionRepository $position)
    {
        $this->position_rep = $position;
    }

    public function index(Request $request)
    {

        $items_per_page = $request->count_items ? $request->count_items : 15;

        $filter_data = [];

        if ($request->search) {
            $filter_data[] = ['name', 'like', '%'.$request->search.'%'];
        }

        $items_per_page = ($items_per_page) ? $items_per_page : $this::COUNT_IN_PAGE;
        $positions  = $this->position_rep->all($filter_data, $items_per_page);

        return response()->jsonresult(true, Errors::OK_POSITION_LIST, [], $positions->toArray());
    }

    public function store(Request $request)
    {
        $position  = $this->position_rep->create(['name'=>$request->name]);
        return response()->jsonresult(true, Errors::OK_POSITION_CREATED, [], $position->toArray());
    }

    public function update(Request $request, $id)
    {
        $position = $this->position_rep->find($id);
        if ($position == null) {
            return response()->goterror(Errors::ERROR_POSITION_NOT_FOUND, []);
        }

        $position = $this->position_rep->update($id, $request->all());
        return response()->jsonresult(true, Errors::OK_POSITION_UPDATED, [], $position);
    }

}
