<?php

namespace App\Http\Controllers;

use App\Exports\ContestsExport;
use App\Http\Requests\CreateAgeGroupRequest;
use App\Http\Requests\CreateContestRequest;
use App\Http\Requests\CreateThemeRequest;
use App\Models\AgeGroup;
use App\Models\Contest;
use App\Models\Theme;
use App\Services\ContestService;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Request;

class ContestController extends Controller
{
    public function __construct(ContestService $contestService)
    {
        $this->contestService = $contestService;

        $this->middleware('jwt.auth', ['except' => ['getAll', 'getAgeGroups', 'getThemes']]);
    }

    public function index(): JsonResponse
    {
        return $this->contestService->pagination();
    }
    public function getAll(): JsonResponse
    {
        return $this->contestService->getAll();
    }

    public function store(CreateContestRequest $request): JsonResponse
    {
        return $this->contestService->store($request->validated());
    }

    public function update(Contest $contest, CreateContestRequest $request): JsonResponse
    {
        return $this->contestService->update($contest, $request->validated());
    }

    public function destroy(Contest $contest): JsonResponse
    {
        return $this->contestService->delete($contest);
    }

    public function getAllThemes(): JsonResponse
    {
        return $this->contestService->getAllThemes();
    }

    public function getAllAgeGroups(): JsonResponse
    {
        return $this->contestService->getAllAgeGroups();
    }
    public function getAgeGroups(Contest $contest): JsonResponse
    {
        return $this->contestService->getAgeGroups($contest);
    }
    public function setAgeGroups(Contest $contest, CreateAgeGroupRequest $request): JsonResponse
    {
        return $this->contestService->setAgeGroups($contest, $request->validated());
    }
    public function editAgeGroups(AgeGroup $ageGroup, CreateAgeGroupRequest $request): JsonResponse
    {
        return $this->contestService->editAgeGroups($ageGroup, $request->validated());
    }

    public function getThemes(AgeGroup $ageGroup): JsonResponse
    {
        return $this->contestService->getThemes($ageGroup);
    }
    public function setThemes(AgeGroup $ageGroup, CreateThemeRequest $request): JsonResponse
    {
        return $this->contestService->setThemes($ageGroup, $request->validated());
    }
    public function editThemes(Theme $theme, CreateThemeRequest $request): JsonResponse
    {
        return $this->contestService->editThemes($theme, $request->validated());
    }

    public function removeAgeGroups(AgeGroup $ageGroup): JsonResponse
    {
        return $this->contestService->removeAgeGroups($ageGroup);
    }
    public function removeThemes(Theme $theme): JsonResponse
    {
        return $this->contestService->removeThemes($theme);
    }

    public function protocol($contestId)
    {
        return (new ContestsExport($contestId))->download('contests.xlsx');
    }
}
