<?php

namespace App\Annotations\OpenApi\controllersAnnotations\studentAnnotations;

class AnnotationsStudent
{
    /**
     * Llista de tots els estudiants
     *
     * @OA\Get (
     *     path="/students",
     *     operationId="getAllStudents",
     *     tags={"Student"},
     *     summary="Get a list of all students.",
     *     description="Get a list of all registered students.

     No authentication required",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. Returns a list of registered students.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="name",type="string",example="John" ),
     *                     @OA\Property(property="surname", type="string",example="Doe"),
     *                     @OA\Property(property="photo",description="Student Image Path",
     *                          type="string",
     *                          example="https://itaperfils.eurecatacademy.org/img/stud_1.png"),
     *                     @OA\Property(property="status", type="enum",example="Active"),
     *                     @OA\Property(property="id", type="uuid",example="9b7dae57-447f-48dc-b175-d243f093bb37")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * Crea un estudiant
     *
     * @OA\Post (
     *     path="/students",
     *     operationId="createStudent",
     *     tags={"Student"},
     *     summary="Create a new Student.",
     *     description="Creates a new user student. Authentication is not required.",
     *
     *     @OA\RequestBody(
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *              @OA\Property(property="dni", type="string", example="13954476P"),
     *              @OA\Property(property="password", type="string", format="password", example="secretpassword"),
     *              @OA\Property(property="subtitle", type="string", example="Engineer and Developer."),
     *              @OA\Property(property="bootcamp", type="string", example="PHP Developer"),
     *              @OA\Property(property="end_date", type="date", example="..."),
     *          )
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Student created successfully. No token is returned.",
     *
     *         @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Student created successfully.")
     *          )
     *     ),
     *
     *     @OA\Response(
     *          response=422,
     *          description="Validation error",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object",
     *                  example={
     *                      "name": {"The name field is required."},
     *                      "surname": {"The surname field is required."},
     *                      "email": {"The email field is required."},
     *                      "email": {"The email must be unique."},
     *                      "dni": {"The dni/nie must be unique."},
     *                      "subtitle": {"The subtitle field is required."},
     *                      "bootcamp": {"The bootcamp field is required."},
     *                  }
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *            response=404,
     *            description="Register was not succesful.Please try it again later."
     *      ),
     * )
     */
    public function store() {}

    /**
     * Detalls d'un estudiant
     *
     * @OA\Get (
     *     path="/students/{id}",
     *     operationId="getStudentDetails",
     *     tags={"Student"},
     *     summary="Get details of a Student.",
     *     description="Get the details of a specific student. Authentication is not required.",
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the student",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          ),
     *      ),
     *
     *      @OA\Response(
     *         response=200,
     *         description="Success. Returns student details.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *
     *                 @OA\Items(
     *                     type="object",
     *
     *                     @OA\Property(property="name", type="string", example="John"),
     *                     @OA\Property(property="surname",type="string", example="Doe"),
     *                     @OA\Property(property="subtitle", type="string", example="Engineer and Developer."),
     *                     @OA\Property(property="about", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."),
     *                     @OA\Property(property="cv", type="string", example="My currículum."),
     *                     @OA\Property(property="bootcamp", type="string", example="PHP Developer"),
     *                     @OA\Property(property="end_date", type="date", example="..." ),
     *                     @OA\Property(property="linkedin", type="string", example="http://www.linkedin.com"),
     *                     @OA\Property(property="github", type="string", example="http://www.github.com")
     *                 )
     *             )
     *         )
     *     ),
     *
     *            @OA\Response(
     *            response=404,
     *            description="User not found."
     *     ),
     * )
     */
    public function show() {}

    /**
     * Actualitza les dades d'un estudiant
     *
     * @OA\Put(
     *      path="/students/{id}",
     *      operationId="updateStudent",
     *      tags={"Student"},
     *      summary="Update a Student.",
     *      description="Update the details of a specific User. Requires student or admin role and valid token.",
     *      security={ {"bearerAuth": {} } },
     ** @OA\Parameter(
  *     name="id",
 *     in="path",
 *     required=true,
 *     description="UUID of the tag to be deleted",
 *     @OA\Schema(type="string", format="uuid"),
 * ),
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="subtitle", type="string", example="Engineer and Full Stack Developer"),
     *              @OA\Property(property="bootcamp", type="enum", example="PHP Developer"),
     *              @OA\Property(property="about", type="text", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."),
     *              @OA\Property(property="cv", type="string", example="Updated Curriculum."),
     *              @OA\Property(property="linkedin", type="string", example="http://www.linkedin.com"),
     *              @OA\Property(property="github", type="string", example="http://www.github.com"),
     *
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success. Returns Student details.",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="subtitle", type="string", example="Engineer and Full Stack Developer"),
     *              @OA\Property(property="bootcamp", type="enum", example="PHP Developer"),
     *              @OA\Property(property="end_date",type="date",example="..." ),
     *              @OA\Property(property="about", type="text", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."),
     *              @OA\Property(property="cv", type="string", example="Updated Curriculum."),
     *              @OA\Property(property="linkedin", type="string", example="http://www.linkedin.com"),
     *              @OA\Property(property="github", type="string", example="http://www.github.com"),
     *
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized. Missing authentication token, admin role, student role, or not matching id.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Unauthorized.")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="It was not possible to complete transaction.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Something went wrong. Try it again later.")
     *          )
     *      )
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *      path="/students/{id}",
     *      operationId="deleteStudent",
     *      tags={"Student"},
     *      summary="Delete a Student.",
     *      description="Delete a specific Student-User by his ID. Requires student or admin role and valid token.",
     *      security={{"bearerAuth":{}}},
     *
     *  * @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="UUID of the student to be deleted",
     *     @OA\Schema(type="string", format="uuid"),
     * ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Student deleted successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Student deleted successfully")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized. Missing authentication token, admin role, student role, or not matching id.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Unauthorized.")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="It was not possible to complete transaction.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Something went wrong. Try it again later-")
     *          )
     *      )
     * )
     */
    public function delete() {}
}
