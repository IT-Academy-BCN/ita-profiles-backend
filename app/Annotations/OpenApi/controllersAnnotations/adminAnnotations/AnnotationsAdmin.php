<?php

namespace App\Annotations\OpenApi\controllersAnnotations\adminAnnotations;

class AnnotationsAdmin
{
    /**
     * @OA\Get(
     *      path="/admins",
     *      operationId="getAllAdmins",
     *      tags={"Admins"},
     *      summary="Get all admins",
     *      description="Get a list of all admins. Requires admin role and valid token.",
     *      security={ {"bearerAuth": {} } },
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation. Returns a list of admins.",
     *
     *          @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(
     *                  type="object",
     *
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="name", type="string", example="John"),
     *                  @OA\Property(property="surname", type="string", example="Doe"),
     *                  @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized. Token is missing or invalid."
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden. User does not have the necessary permissions (admin role)."
     *      ),
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *      path="/admins",
     *      operationId="createAdmin",
     *      tags={"Admins"},
     *      summary="Create a new admin",
     *      description="Creates a new admin user with an invitation code.",
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
     *              @OA\Property(property="password", type="string", format="password", example="secretpassword"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Admin created successfully. No token is returned.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Admin created successfully.")
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
     *      path="/admins/{id}",
     *      operationId="getAdminDetails",
     *      tags={"Admins"},
     *      summary="Get details of an administrator",
     *      description="Get the details of a specific administrator. Requires admin role and valid token.",
     *      security={ {"bearerAuth": {} } },
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the administrator",
     *          required=true,
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success. Returns administrator details.",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="John"),
     *              @OA\Property(property="surname", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden. Missing authentication token or admin role."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found. Administrator with specified ID not found."
     *      ),
     * )
     */
    public function show() {}

    /**
     * @OA\Put(
     *      path="/admins/{id}",
     *      operationId="updateAdmin",
     *      tags={"Admins"},
     *      summary="Update an administrator",
     *      description="Update the details of a specific administrator. Requires admin role and valid token.",
     *      security={{"bearerAuth": {}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the administrator",
     *          required=true,
     *
     *          @OA\Schema(type="integer"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="New name of the administrator",
     *          required=false,
     *
     *          @OA\Schema(type="string", example="NewJohn"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="surname",
     *          in="query",
     *          description="New surname of the administrator",
     *          required=false,
     *
     *          @OA\Schema(type="string", example="NewDoe"),
     *      ),
     *
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="New email of the administrator",
     *          required=false,
     *
     *          @OA\Schema(type="string", format="email", example="newjohn@example.com"),
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
     *          description="Success. Returns updated administrator details.",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="id", type="integer", example=1),
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
     *          description="Not Found. Administrator with specified ID not found."
     *      ),
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *      path="/admins/{id}",
     *      operationId="deleteAdmin",
     *      tags={"Admins"},
     *      summary="Delete an admin",
     *      description="Delete a specific admin by their ID",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the admin to be deleted",
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
     *          description="Admin deleted successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Admin deleted successfully")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized. Missing authentication token or admin role.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Unauthorized. Missing authentication token or admin role.")
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="Admin not found",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="No admins found in the database")
     *          )
     *      )
     * )
     */
    public function delete() {}
}
