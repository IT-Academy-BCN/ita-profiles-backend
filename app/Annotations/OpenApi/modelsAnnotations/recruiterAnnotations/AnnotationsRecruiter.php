<?php

namespace App\Annotations\OpenApi\modelsAnnotations\recruiterAnnotations;

/**
 * @OA\Schema(
 *     title="Recruiter",
 *     description="Recruiter Model",
 *
 *     @OA\Xml(
 *         name="Recruiter"
 *     )
 * )
 *
 * @OA\Property(
 *     property="id",
 *     description="Recruiter ID",
 *     type="integer",
 *     format="int64"
 * )
 *
 * @var int
 *
 * @OA\Property(
 *     property="company",
 *     description="Recruiter Company",
 *     type="string",
 *     format="int64"
 * )
 *
 * @var string
 *
 * @OA\Property(
 *     property="user_id",
 *     description="ID of the associated User",
 *     type="integer",
 *     format="int64"
 * )
 *
 * @var int
 *
 * @OA\Property(
 *     property="created_at",
 *     description="Creation date of the Recruiter record",
 *     type="string",
 *     format="date-time"
 * )
 *
 * @var \Illuminate\Support\Carbon
 *
 * @OA\Property(
 *     property="updated_at",
 *     description="Update date of the Recruiter record",
 *     type="string",
 *     format="date-time"
 * )
 *
 * @var \Illuminate\Support\Carbon
 */
class AnnotationsRecruiter {}
