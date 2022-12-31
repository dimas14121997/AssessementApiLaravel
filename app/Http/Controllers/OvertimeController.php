<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCalculatedRequest;
use App\Repositories\OvertimeRepository;
use App\Models\Overtime;
use App\Http\Requests\StoreOvertimeRequest;
use App\Http\Requests\GetOvertimeRequest;
use Exception;

class OvertimeController extends Controller
{
    protected $overtimeRepository;

    public function __construct(OvertimeRepository $overtimeRepository)
    {
        $this->overtimeRepository = $overtimeRepository;
    }
    /**
     * @OA\Post(
     *      path="/api/overtimes",
     *      operationId="addovertimes",
     *      tags={"overtimes"},
     *      summary="Add overtimes",
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
     *                      property="employee_id",
     *                      type="integer",
     *                      example="1",
     *                  ),
     *                  @OA\Property(
     *                      property="time_started",
     *                      type="time",
     *                      example="08:21",
     *                  ),
     *                  @OA\Property(
     *                      property="time_ended",
     *                      type="time",
     *                      example="11:38",
     *                  ),
     *                  @OA\Property(
     *                      property="date",
     *                      type="date",
     *                      example="2022-04-11",
     *                  ),
     *              ),
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
    public function store(StoreOvertimeRequest $request)
    {
        try {
            $overtimes = $this->overtimeRepository->store($request->validated());
            return response($overtimes, 200);
        } catch (Exception $err) {
            return response(['error' => $err->getMessage()], 500);
        }
    }
    /**
     * @OA\Get(
     *      path="/api/overtimes",
     *      operationId="getovertimesList",
     *      tags={"overtimes"},
     *      summary="Get list of overtimes",
     *      description="Returns list of overtimes",
     *      @OA\Header(
     *          header="application/json"
     *      ),
     *      @OA\Parameter(
     *          name="date_started",
     *          description="started date",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          example="2022-04-10",
     *      ),
     *      @OA\Parameter(
     *          name="date_ended",
     *          description="ended date",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          example="2022-04-12",
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
    public function show(GetOvertimeRequest $request)
    {
        try {
            $overtimes = $this->overtimeRepository->showByRange($request->validated());
            return response($overtimes, 200);
        } catch (Exception $err) {
            return response(['error' => $err->getMessage()], 500);
        }
    }
    /**
     * @OA\Get(
     *      path="/api/overtime-pays/calculate",
     *      operationId="getcalculatedOvertimes",
     *      tags={"overtimes"},
     *      summary="Get list of calculated overtimes",
     *      description="Returns list of calculated overtimes",
     *      @OA\Header(
     *          header="application/json"
     *      ),
     *      @OA\Parameter(
     *          name="month",
     *          description="month",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *          example="2022-04",
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
    public function calculate(GetCalculatedRequest $request)
    {
        try {
            $overtimes = $this->overtimeRepository->calculatePays($request->validated());
            return $overtimes;
        } catch (Exception $err) {
            return response(['error' => $err->getMessage()], 500);
        }
    }
}
