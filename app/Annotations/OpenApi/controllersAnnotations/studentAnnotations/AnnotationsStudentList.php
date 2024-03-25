<?php

namespace App\Annotations\OpenApi\controllersAnnotations\studentAnnotations;

class AnnotationsStudentList
{
    /**
     * @OA\Get(
     *     path="/student/list/for-home",
     *     operationId="getAllStudentsForFigma",
     *     tags={"Student"},
     *     summary="Get Students List.",
     *
     *     description="Get a list of all students registered with the Profile-Home fields in Figma Design.

- If a 'specialization' parameter is provided, the list will be filtered by student's specialization.

- If not, it returns a list of all students.

- Multiple parameters can be added separated by commas without spaces.

- For example, if the objetive is to filter Backend and Frontend students, the query would be:

    ```/student/list/for-home?specialization=frontend,backend```
    - To filter by tags, the query would be:
    ```/student/list/for-home?tags=PHP,Laravel```
    - To filter by both specialization and tags:
    ```/student/list/for-home?specialization=frontend&tags=php,react```

---

    No authentication required",
     *
     *     @OA\Parameter(
     *       name="specialization",
     *       in="query",
     *       description="The specializations to filter students by",
     *       required=false,
     *       style="form",
     *       explode=true,
     *
     *       @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *       name="tags",
     *       in="query",
     *       description="The tags to filter students by",
     *       required=false,
     *       style="form",
     *       explode=true,
     *       @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="A list of students",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *                 type="object",
     *
     *                 @OA\Property(
     *                    property="fullname",
     *                    type="string",
     *                    example="Juan Pérez"),
     *                 @OA\Property(
     *                    property="subtitle",
     *                    type="string",
     *                    example="Desarrollador Frontend"),
     *                 @OA\Property(
     *                    property="photo",
     *                    description="Student Image Path",
     *                     type="string",
     *                     example="https://itaperfils.eurecatacademy.org/img/stud_1.png"),
     *                 @OA\Property(
     *                   property="tags",
     *                   type="array",
     *
     *                   @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(property="id", type="integer", example=15),
     *                     @OA\Property(property="name", type="string", example="C#"),
     *                     example={"id": 15, "name": "C#"}
     *                   ),
     *                 )
     *             )
     *          )
     *      ),
     * )
     */
    public function __invoke() {}
}
