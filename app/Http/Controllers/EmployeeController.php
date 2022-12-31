<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Repositories\EmployeeRepository;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * @OA\Get(
     *      path="/api/employees",
     *      operationId="getemployeesList",
     *      tags={"employees"},
     *      summary="Get list of employees",
     *      description="Returns list of employees",
     *      @OA\Header(
     *          header="application/json"
     *      ),
     *      @OA\Parameter(
     *          name="per_page",
     *          description="number of employee of each page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *          example="5",
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="current page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *          example="1",
     *      ),
     *      @OA\Parameter(
     *          name="order_by",
     *          description="parameter for order",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          example="name",
     *      ),
     *      @OA\Parameter(
     *          name="order_type",
     *          description="order method",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          example="ASC",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation errors"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Errors"
     *      ),
     *     )
     */
    public function index(GetEmployeeRequest $request)
    {
        try {
            $employees = $this->employeeRepository->getPaginate($request->validated());
            return response($employees, 200);
        } catch (Exception $err) {
            return response(['error' => $err->getMessage()], 500);
        }
    }
    /**
     * @OA\Post(
     *      path="/api/employees",
     *      operationId="addemployees",
     *      tags={"employees"},
     *      summary="Add employees",
     *      description="Returns status",
     *      @OA\Header(
     *          header="application/json"
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="status_id",
     *                      type="integer",
     *                  ),
     *                  @OA\Property(
     *                      property="salary",
     *                      type="integer",
     *                  ),
     *              ),
     *              example={
     *                  "name":"Nama Orang",
     *                  "status_id":"3",
     *                  "salary":"5000000",
     *              }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Data Recorded",
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Errors"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Errors"
     *      ),
     *     )
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $result = $this->employeeRepository->store($request->validated());
            return response($result, 201);
        } catch (Exception $err) {
            return response(['error' => $err->getMessage()], 500);
        }
    }

}
