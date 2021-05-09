<?php

namespace App\Http\Controllers;

use App\Models\Contestant;
use App\Models\NewsletterStatus;
use App\Services\NewsletterService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsletterController extends Controller
{
    //
    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;

//        $this->middleware('jwt.auth');
    }

    public function index(): JsonResponse
    {
        return $this->newsletterService->pagination();
    }

    public function getAll(): JsonResponse
    {
        return $this->newsletterService->getAll();
    }

    public function getByStatus(NewsletterStatus $newsletterStatus): JsonResponse
    {
        return $this->newsletterService->getByStatus($newsletterStatus->id);
    }

    public function getCountStatus(): JsonResponse
    {
        return $this->newsletterService->getCountStatus();
    }

    public function start() : JsonResponse
    {
        $contestants = Contestant::whereHas('application', function (Builder $builder){
           $builder->whereHas('status', function (Builder  $builder){
                $builder->where('status', 'success');
           });
        })->get();

        foreach ($contestants as $contestant){
            $this->newsletterService->start($contestant->id, 1);
        }
        return response()->json(['message' => 'Рассылка успешно создана']);
    }

}
