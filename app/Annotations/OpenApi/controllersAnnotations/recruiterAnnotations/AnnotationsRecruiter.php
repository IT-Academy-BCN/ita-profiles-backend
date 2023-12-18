<?php

namespace App\Annotations\OpenApi\controllersAnnotations\recruiterAnnotations;

class AnnotationsRecruiter
{
    /**
     * Llista tots els reclutadors
     *
     * @OA\Get(
     *     path="/recruiters",
     *     operationId="getAllRecruiters",
     *     tags={"Recruiters"},
     *     summary="Get a list of all recruiters.",
     *     description="Get a list of all registered recruiters. No authentication is required.",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation. Returns a list of registered recruiters.",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *                 type="object",
     *
     *                 @OA\Property(property="name", type="string", example="Laura"),
     *                 @OA\Property(property="surname", type="string", example="González"),
     *                 @OA\Property(property="company", type="string", example="ABC Corporation"),
     *                 @OA\Property(property="sector", type="string", example="Technology")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="No recruiters found in the database.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="No hi ha reclutadors a la base de dades.")
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *      path="/recruiters",
     *      operationId="createRecruiter",
     *      tags={"Recruiters"},
     *      summary="Create a new recruiter",
     *      description="Creates a new recruiter user with an invitation code.",
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *              @OA\Property(property="dni", type="string", example="12345678Y, X7959970T"),
     *               @OA\Property(property="company", type="string", example="Apple"),
     *              @OA\Property(property="sector", type="string", example="TIC"),
     *              @OA\Property(property="password", type="string", format="password", example="secretpassword"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Recruiter created successfully. No token is returned.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Recruiter created successfully.")
     *          )
     *      ),
     *
     *      @OA\Response(
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
     *                      "email": {"The email must be unique."},
     *                      "dni": {"The dni/nie must be unique."}
     *                  }
     *              )
     *          )
     *      ),
     *
     *
     *
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *      path="/recruiters/{id}",
     *      operationId="getRecruiterDetails",
     *      tags={"Recruiters"},
     *      summary="Get details of an recruiter",
     *      description="Get the details of a specific recruiter. Requires recruiter role and valid token.",
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the recruiter",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success. Returns recruiter details.",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *               @OA\Property(property="company", type="string", example="Apple"),
     *               @OA\Property(property="sector", type="string", example="TIC"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *          )
     *      ),
     *

     *      @OA\Response(
     *          response=404,
     *          description="Not Found. recruiter with specified ID not found."
     *      ),
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *      path="/recruiters/{id}",
     *      operationId="updateRecruiter",
     *      tags={"Recruiters"},
     *      summary="Update an recruiter",
     *      description="Update the details of a specific recruiter. Requires recruiter role and valid token.",
     *      security={{"bearerAuth": {}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the recruiter",
     *          required=true,
     *
     *          @OA\Schema(type="integer"),
     *      ),
     *
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data to be updated",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success. Returns updated recruiter details.",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="name", type="string", example="NewJohn"),
     *              @OA\Property(property="surname", type="string", example="NewDoe"),
     *              @OA\Property(property="email", type="string", format="email", example="newjohn@example.com"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="You do not have permission to modify this user"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found. recruiter with specified ID not found."
     *      ),
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *      path="/recruiters/{id}",
     *      operationId="deleteRecruiter",
     *      tags={"Recruiters"},
     *      summary="Delete an recruiter",
     *      description="Delete a specific recruiter by their ID",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the recruiter to be deleted",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="recruiter deleted successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="recruiter deleted successfully")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized. Missing authentication token or recruiter role.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Unauthorized. Missing authentication token or recruiter role.")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="recruiter not found",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="No recruiters found in the database")
     *          )
     *      )
     * )
     */
    public function delete() {}
}
