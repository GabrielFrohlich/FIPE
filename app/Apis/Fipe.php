<?php

namespace App\Apis;

use Illuminate\Support\Facades\Http;

class Fipe
{

    private $http_client;

    /**
     * Construct function
     * 
     * @return Fipe
     */
    public function __construct()
    {
        $this->http_client = Http::baseUrl(config('apis.fipe.base_url'));
    }

    /**
     * Verify if type are valid
     * 
     * @param string $type
     * 
     * @return void
     */
    protected function verifyTypes($type)
    {
        if(!in_array($type, ['carros', 'motos', 'caminhoes'])) {
            throw new \Exception('Invalid type');
        }
    }

    /**
     * Get all brands from a given type
     * 
     * @param string $type
     * @return mixed
     */
    public function getBrands(string $type): mixed
    {
        $this->verifyTypes($type);

        $response = $this->http_client->get("/fipe/api/v1/{$type}/marcas");

        if(!$response->ok())
            abort(404);

        return $response->json();
    }

    /**
     * Get all vehicles from a given brand
     * 
     * @param int $brand_id
     * @return mixed
     */
    public function getVehicles(string $type, int $brand_id): mixed
    {
        $this->verifyTypes($type);
        
        $response = $this->http_client->get("/fipe/api/v1/$type/marcas/$brand_id/modelos");

        if(!$response->ok())
            abort(404);

        return $response->json();
    }

    /**
     * Get all years from a given Vehicle
     * 
     * @param int $brand_id
     * @param int $vehicle_id
     * @return mixed
     */
    public function getVehicleYears(string $type, int $brand_id, int $vehicle_id): mixed
    {
        $this->verifyTypes($type);
        
        $response = $this->http_client->get("/fipe/api/v1/$type/marcas/$brand_id/modelos/$vehicle_id/anos");

        if(!$response->ok())
            abort(404);

        return $response->json();
    }

    /**
     * Get info about a vehicle
     * 
     * @param string $type
     * @param int $brand_id
     * @param int $vehicle_id
     * @param string $vehicle_year
     * 
     * @return mixed
     */
    public function getVehicle(string $type, int $brand_id, int $vehicle_id, string $vehicle_year): mixed
    {
        $this->verifyTypes($type);

        $response = $this->http_client->get("/fipe/api/v1/$type/marcas/$brand_id/modelos/$vehicle_id/anos/$vehicle_year");

        if (!$response->ok())
            abort(404);

        return $response->json();
    }
}