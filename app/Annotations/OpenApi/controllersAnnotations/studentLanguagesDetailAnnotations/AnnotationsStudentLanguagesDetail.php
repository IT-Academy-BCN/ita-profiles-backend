<?php

namespace App\Annotations\OpenApi\controllersAnnotations\studentLanguagesDetailAnnotations;

use OpenApi\Annotations as OA;

class AnnotationsStudentLanguagesDetail
{
    /**
     * @OA\Get(
     *      path="/students/{uuid}/languages",
     *      operationId="getStudentLanguages",
     *      tags={"Languages"},
     *      summary="Get a detailed list of languages and level for a student",
     *      description="Returns a list of Languages and level for a specific student. (Note: This endpoint returns hardcoded project details)",
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Student UUID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(
     *                      property="language_id",
     *                      type="int",
     *                      description="id for languange"
     *                  ),
     *                  @OA\Property(
     *                      property="language_name",
     *                      type="string",
     *                      description="Language"
     *                  ),
     *                  @OA\Property(
     *                      property="language_level",
     *                      type="string",
     *                      description="Language level"
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Student not found"
     *      )
     * )
     */

    public function __invoke() {}
}
