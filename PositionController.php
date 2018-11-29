<?php
namespace App\Http\Controllers\Api;

use App\Errors;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use App\Services\PositionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController
{

    protected $position_service;

    public function __construct(PositionService $service)
    {
        $this->position_service = $service;
    }

    /**
     * Создание должности
     * @param Request $request
     * @return array
     *
     * @SWG\Post(
     *     path="/api/v1/positions/",
     *     description="Создание должности",
     *     operationId="api.v1.positions.create",
     *     produces={"application/json"},
     *     tags={"Доступно авторизированным пользователям"},
     *     @SWG\Parameter(name="Authorization",in="header",description="токен доступа",required=true,type="string", default="Bearer `accessToken`"),
     *     @SWG\Parameter(name="name",in="formData",description="Название должности",required=true,type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Должность",
     *         examples={
     *           "application/json": {
     *               "status"=true,
     *               "data"={"id"="1","name"="Дворник","updated_at"="2018-10-11 14:24:11","created_at"="2018-10-11 14:24:11"},
     *               "errors"={}
     *            }
     *          }
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="",
     *         examples={
     *           "application/json": {
     *               "status"=false,
     *               "data"={},
     *               "message"="",
     *               "errors"={"name": {"The name field is required."}}
     *            }
     *          }
     *     ),
     * )
     */
    public function store(PositionRequest $request)
    {
        return $this->position_service->store($request);
    }

    /**
     * Редактирование должности
     * @param Request $request
     * @param int $id
     * @return array
     *
     * @SWG\Put(
     *     path="/api/v1/positions/{id}",
     *     description="Редактирование должности",
     *     operationId="api.v1.positions.update",
     *     produces={"application/json"},
     *     tags={"Доступно авторизированным пользователям"},
     *     @SWG\Parameter(name="Authorization",in="header",description="токен доступа",required=true,type="string", default="Bearer `accessToken`"),
     *     @SWG\Parameter(name="id",in="path",description="ID должности",required=true,type="integer"),
     *     @SWG\Parameter(name="name",in="formData",description="Название должности",required=true,type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Должность",
     *         examples={
     *           "application/json": {
     *               "status"=true,
     *               "data"={"id"="1","name"="Дворник","updated_at"="2018-10-11 14:24:11","created_at"="2018-10-11 14:24:11"},
     *               "errors"={}
     *            }
     *          }
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="",
     *         examples={
     *           "application/json": {
     *               "status"=false,
     *               "data"={},
     *               "message"="",
     *               "errors"={"name": {"The name field is required."}}
     *            }
     *          }
     *     ),
     * )
     */
    public function update(PositionRequest $request, $id)
    {
        return $this->position_service->update($request);
    }

    /**
     * Список должностей
     * @param Request $request
     * @return array
     *
     * @SWG\Get(
     *     path="/api/v1/positions/",
     *     description="Список должностей",
     *     operationId="api.v1.positions.index",
     *     produces={"application/json"},
     *     tags={"Доступно авторизированным пользователям"},
     *     @SWG\Parameter(name="Authorization",in="header",description="токен доступа",required=true,type="string", default="Bearer `accessToken`"),
     *     @SWG\Parameter(name="search",in="query",description="поисковый запрос",required=false,type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Должность",
     *         examples={
     *           "application/json": {
     *               "status"=true,
     *               "data"={
     *                  "current_page"=1,
     *                  "data":{{"id"="1","name"="Дворник","updated_at"="2018-10-11 14:24:11","created_at"="2018-10-11 14:24:11"}},
     *                  "first_page_url"="http://audit.local:8080/api/v1/position?page=1",
     *                  "from"=1,
     *                  "last_page"=1,
     *                  "last_page_url"="http://audit.local:8080/api/v1/position?page=1",
     *                  "next_page_url"=null,
     *                  "path"="http://audit.local:8080/api/v1/position",
     *                  "per_page"=1,
     *                  "prev_page_url"=null,
     *                  "to"=1,
     *                  "total"=1
     *              },
     *               "errors"={}
     *            }
     *          }
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="",
     *         examples={
     *           "application/json": {
     *               "status"=false,
     *               "data"={},
     *               "message"="",
     *               "errors"={}
     *            }
     *          }
     *     ),
     * )
     */
    public function index(Request $request)
    {
        return $this->position_service->index($request);
    }

}
