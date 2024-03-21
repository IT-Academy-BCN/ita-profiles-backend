<?php

namespace App\Annotations\OpenApi\controllersAnnotations\studentProjectsDetailAnnotations;

use OpenApi\Annotations as OA;

class AnnotationsStudentProjectsDetail
{
    /**
     * @OA\Get(
     *      path="/students/{uuid}/projects",
     *      operationId="getStudentProjects",
     *      tags={"Projects"},
     *      summary="Get a detailed list of projects for a student",
     *      description="Returns a list of projects for a specific student.",
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
     *                      property="project_name",
     *                      type="string",
     *                      description="Name of the project"
     *                  ),
     *                  @OA\Property(
     *                      property="project_site",
     *                      type="string",
     *                      description="Site where the project is happening"
     *                  ),
     *                  @OA\Property(
     *                      property="project_skills",
     *                      type="array",
     *                      @OA\Items(type="string"),
     *                      description="Skills required for the project"
     *                  ),
     *                  @OA\Property(
     *                      property="project_repository",
     *                      type="string",
     *                      description="URL of the project repository"
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
