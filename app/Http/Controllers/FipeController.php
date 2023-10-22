<?php

namespace App\Http\Controllers;

use App\Apis\Fipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FipeController extends Controller
{
    protected $fipe;

    /**
     * Construct the object
     */
    public function __construct()
    {
        $this->fipe = new Fipe();
    }

    /**
     * Filter values from a given array
     * 
     * @param array $item
     * @param string $key
     * 
     * return array
     */
    private function filterValues($item, $key)
    {
        $input = strtolower(request()->q);
        $brand_name = strtolower($item[$key]);

        similar_text($input, $brand_name, $percent);

        if ($percent > 80 || str_contains($brand_name, $input))
            return $item;
    }

    /**
     * Get all brands from a given type
     * 
     * @param Request $request
     * @param string $type
     * @return Illuminate\Http\JsonResponse
     */
    public function getBrands(Request $request, string $type)
    {
        $brands = $this->fipe->getBrands($type);

        $brands = collect($brands)->filter(function ($item) {
            return $this->filterValues($item, 'nome');
        });

        return response()->json(array_values($brands->all()));
    }

    /**
     * Get all vehicles from a given brand
     * 
     * @param Request $request
     * @param string $type
     * @param int $brand_id
     * @return Illuminate\Http\JsonResponse
     */
    public function getModels(Request $request, string $type, int $brand_id)
    {
        $models = $this->fipe->getVehicles($type, $brand_id);

        $models = collect($models['modelos'])->filter(function ($item) {
            return $this->filterValues($item, 'nome');
        });

        if ($request->wantsJson()) {
            return response()->json(array_values($models->all()));
        }

        return view('data', [
            'tableData' => array_values($models->all()),
            'baselink' => "/fipe/{$type}/{$brand_id}"
        ]);
    }

    /**
     * Get all years from a given model
     * 
     * @param Request $request
     * @param string $type
     * @param int $brand_id
     * @param int $model_id
     * @return Illuminate\Http\JsonResponse
     */
    public function getVehicleYears(Request $request, string $type, int $brand_id, int $model_id)
    {

        $years = $this->fipe->getVehicleYears($type, $brand_id, $model_id);

        $years = collect($years)->filter(function ($item) {
            return $this->filterValues($item, 'nome');
        });

        if ($request->wantsJson()) {
            return response()->json(array_values($years->all()));
        }



        return view('data', [
            'tableData' => array_values($years->all()),
            'baselink' => "/fipe/{$type}/{$brand_id}/{$model_id}"
        ]);
    }

    /**
     * View Vehicle
     * 
     * @param Request $request
     * 
     */
    public function viewVehicle(Request $request, string $type, int $brand_id, int $model_id, string $year)
    {
        $vehicle = $this->fipe->getVehicle($type, $brand_id, $model_id, $year);

        return view('vehicle', [
            'vehicle' => $vehicle,
            'type' => $type,
            'model_id' => $model_id,
            'year' => $year,
            'brand_id' => $brand_id,
        ]);
    }
}
