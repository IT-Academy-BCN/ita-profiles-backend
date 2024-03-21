<?php 
namespace App\Annotations\OpenApi\controllersAnnotations\modalityAnnotations;

class AnnotationsModality
{

     /**
     * @OA\Get(
     *     path="/api/v1/modality",
     *     summary="Retrieve a specialization list from resume model enum",
     *     tags={"Modality"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful. Specialization list retrieved from enum",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(type="string")
     *         )
     *     )
     * )
     */

    public function __invoke() {}
}