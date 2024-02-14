<?php

namespace App\Http\Controllers\api;

use App\Exceptions\UserNotAuthenticatedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeUpdateRequest;
use App\Models\Resume;
use App\Service\Resume\ResumeDeleteService;
use App\Service\Resume\ResumeUpdateService;
use App\Service\Resume\ResumeCreateService;
use App\Service\Resume\ResumeShowService;
use App\Http\Resources\ResumeShowResource;
use App\Http\Requests\ResumeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\DuplicateResumeException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class ResumeController extends Controller
{
    private ResumeUpdateService $resumeUpdateService;
    private ResumeCreateService $resumeCreateService;
    private ResumeDeleteService $resumeDeleteService;
    private ResumeShowService $resumeShowService;

    public function __construct( ResumeCreateService $resumeCreateService,
                                 ResumeUpdateService $resumeUpdateService, 
                                 ResumeDeleteService $resumeDeleteService,
                                 ResumeShowService $resumeShowService,
                             )
    {
        $this->resumeUpdateService = $resumeUpdateService;
        $this->resumeCreateService = $resumeCreateService;
        $this->resumeDeleteService = $resumeDeleteService;
        $this->resumeShowService = $resumeShowService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResumeRequest $request)
    {
        try {
            $user = Auth::guard('api')->user();
            $resume = $this->resumeCreateService->execute($request, $user);
            return response()->json(['message' => 'Currículum creat correctament', 'resume' => $resume], 201);
        } catch (DuplicateResumeException $e) {
            return response()->json(['message' => 'Currículum duplicat', 'error' => $e->getMessage()], 409);
        } catch (Exception $e) {
            return response()->json(['message' => 'No ha pogut crear el currículum', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $resume = $this->resumeShowService->execute($id);
            return response()->json(['resume' => $resume], 200);
        } catch (UserNotAuthenticatedException $e) {
            return response()->json(['message' => 'Usuari no autoritzat'], Response::HTTP_UNAUTHORIZED);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'currículum no trobat'], Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ResumeUpdateRequest $request, string $id)
    {
        try {
            $data = $request->all();
          $this->resumeUpdateService->execute(
                $id,
                $data['subtitle'] ?? null,
                $data['linkedin_url'] ?? null,
                $data['github_url'] ?? null,
                $data['specialization'] ?? null
            );
            return response()->json(['message' => __('Currículum actualitzat.')], 200);
        } catch (ModelNotFoundException $resumeNotFoundExeption) {

            throw new HttpResponseException(response()->json([
                'message' => __(
                    $resumeNotFoundExeption->getMessage()
                )
            ], $resumeNotFoundExeption->getCode()));
        } catch (UserNotAuthenticatedException $userNotAuthException) {
            throw new HttpResponseException(response()->json([
                'message' => __(
                    $userNotAuthException->getMessage()
                )
            ], $userNotAuthException->getHttpCode()));
        }catch(Exception $exception){
            throw new HttpResponseException(response()->json([
                'message' => __(
                    $exception->getMessage()
                )
            ], $exception->getCode()));
        }
    }

    public function destroy(string $id)
    {
        try {
           $this->resumeDeleteService->execute($id);
          

            return response()->json(['message' => __('Currículum eliminat.')], 200);
        } catch (ModelNotFoundException $resumeNotFoundExeption) {

            throw new HttpResponseException(response()->json([
                'message' => __(
                    $resumeNotFoundExeption->getMessage()
                )
            ], $resumeNotFoundExeption->getCode()));
        }
    }
}
