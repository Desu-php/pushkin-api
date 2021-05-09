<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApplicationRequest;
use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ApplicationDocument;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationCreated;
use App\Mail\ApplicationInProcess;


class ApplicationController extends Controller
{

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;

        $this->middleware('jwt.auth', ['except' => ['store', 'upload']]);
        $this->middleware('admin', ['except' => ['get','getAll', 'store', 'upload', 'updateStatus']]);
    }

    public function index() : JsonResponse
    {
        return $this->applicationService->pagination();
    }

    public function get($id): JsonResponse
    {
        return $this->applicationService->get($id);
    }

    public function getAll(): JsonResponse
    {
        return $this->applicationService->getAll();
    }

    public function update(Application $application, CreateApplicationRequest $request): JsonResponse
    {
        return $this->applicationService->update($application, $request->validated());
    }
    public function store(CreateApplicationRequest $request): JsonResponse
    {
        return $this->applicationService->store($request->validated());
    }

    public function upload(Application $application, Request $request): JsonResponse
    {

        if ($request->hasFile('contestFiles')) {
            $files = $request->file('contestFiles');

            foreach ($files as $file) {
                $path = $file->storeAs('applications/' . $application->id, $file->getClientOriginalName());

                $apllicationDocument = new ApplicationDocument();
                $apllicationDocument->name = $file->getClientOriginalName();
                $apllicationDocument->application_id = $application->id;
                $apllicationDocument->save();
            }
        }

        if ($request->hasFile('receiptFile')) {
            $file = $request->file('receiptFile');

            $path = $file->storeAs('applications/' . $application->id, 'receipt' . '.' . $file->getClientOriginalExtension());

            $apllicationDocument = new ApplicationDocument();
            $apllicationDocument->name = 'receipt' . '.' . $file->getClientOriginalExtension();
            $apllicationDocument->application_id = $application->id;
            $apllicationDocument->save();
        }
        $contestants = $application->contestants;
        foreach ($contestants as $contestant) {
            Mail::to($contestant->email)->send(new ApplicationInProcess($application));
        }

        Mail::to('info@pushkin-volga.ru')->send(new ApplicationCreated($application));

        return response()->json(['message' => 'Файлы загружены', 'data' => $path]);
    }

    public function updateStatus(Application $application, Request $request): JsonResponse
    {
        return $this->applicationService->updateStatus($application, $request);
    }
    public function updateUser(Application $application, Request $request): JsonResponse
    {
        return $this->applicationService->updateUser($application, $request);
    }
}
