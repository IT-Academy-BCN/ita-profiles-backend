<?php

namespace App\Annotations\OpenApi\controllersAnnotations\tagAnnotations;

class AnnotationsTag
{
   /**
 * Tag List
 *
 * @OA\Get(
 *     path="/tags",
 *     operationId="getAllTags",
 *     tags={"Tags"},
 *     summary="Tags Index.",
 *     description="Retrieve a list of registered tags. Admin Authentication is required.",
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Successful. Tag Index retrieved.",
 *
 *         @OA\JsonContent(
 *             type="array",
 *
 *             @OA\Items(
 *                 type="object",
 *
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="tag_name", type="string", example="Laravel"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="No tags found.",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="No tags found in the database.")
 *         )
 *     )
 * )
 */
    public function index() {}

    /**
     * @OA\Post(
     *      path="/tags",
     *      operationId="createTag",
     *      tags={"Tags"},
     *      summary="Create a new tag",
     *      description="Creates a new tag. Admin Authentication is required.",
     *      security={{"bearer": {}}},
     *
     *      @OA\RequestBody(
     *            required=true,
     *
     *            @OA\JsonContent(
     *            type="object",
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="tag_name", type="string", example="Laravel"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
     *           )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Tag created successfully.",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Tag created successfully.")
     *          )
     *      ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Error creating the tag.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Error creating the tag. Please try again."),
     *         ),
     *     ),
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *      path="/tags/{id}",
     *      operationId="getTagById",
     *      tags={"Tags"},
     *      summary="Get details of a specific tag",
     *      description="Retrieve details of a specific tag based on the provided ID. Admin Authentication is required.",
     *
     *      security={{"bearer": {}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Tag ID",
     *
     *          @OA\Schema(type="integer", format="int64"),
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Tag details retrieved successfully.",
     *
     *         @OA\JsonContent(
     *
     *             type="object",
     *
     *           @OA\Property(
     *           property="data",
     *           type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="tag_name", type="string", example="Laravel"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Tag not found."),
     *         ),
     *     ),
     *   )
     */
    public function show() {}

    /**
     * @OA\Put(
     *     path="/tags/{id}",
     *     operationId="updateTag",
     *     tags={"Tags"},
     *     summary="Update details of a specific tag.",
     *     description="Updates details of a specific tag based on the provided ID. Admin Authentication is required.",
     *     security={{"bearer": {}}},
     *
     *     @OA\Parameter(

     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the tag to be updated",
     *
     *         @OA\Schema(type="integer", format="int64"),
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="tag_name", type="string", example="Updated Tag"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Tag details retrieved successfully.",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *                 type="object",
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="tag_name", type="string", example="Laravel"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-25T12:34:56Z"),
     *                 @OA\Property(property="message", type="string", example="Tag updated successfully."),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Tag not found."),
     *         ),
     *     ),
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/tags/{id}",
     *     operationId="deleteTag",
     *     tags={"Tags"},
     *     summary="Delete a specific tag.",
     *     description="Deletes a specific tag based on the provided ID. Admin Authentication is required.",
     *     security={{"bearer": {}}},
     *
     *  @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="UUID of the tag to be deleted",
     *     @OA\Schema(type="string", format="uuid"),
     *   ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Tag deleted successfully.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Tag deleted successfully."),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Tag not found.",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Tag not found."),
     *         ),
     *     ),
     * )
     */
    public function delete() {}
}
