<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\UpdateSettingRequest;
use App\Repositories\SettingRepository;
use Exception;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @OA\Patch(
     *      path="/api/settings",
     *      operationId="changesettings",
     *      tags={"settings"},
     *      summary="Change settings",
     *      description="Change settings of the calculation method",
     *      @OA\Header(
     *          header="application/json"
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="key",
     *                      type="string",
     *                      example="overtime_method",
     *                  ),
     *                  @OA\Property(
     *                      property="value",
     *                      type="integer",
     *                      example="1",
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
    public function update(UpdateSettingRequest $request)
    {
        try {
            $setting = $this->settingRepository->changeMethod($request->validated());
            return response(['message'=>'success'], 200);
        } catch (Exception $err) {
            return response(['error' => $err->getMessage()], 500);
        }
    }
}
