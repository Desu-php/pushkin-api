<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Http\Requests\StartNewsletterRequest;
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

    public function index(NewsletterRequest $request): JsonResponse
    {
        return $this->newsletterService->pagination($request->status);
    }

    public function getAll(NewsletterRequest $request): JsonResponse
    {
        return $this->newsletterService->getAll($request->status);
    }

    public function getByStatus(NewsletterRequest $request,NewsletterStatus $newsletterStatus): JsonResponse
    {
        return $this->newsletterService->getByStatus($newsletterStatus->id,$request->status);
    }

    public function getCountStatus(NewsletterRequest $request): JsonResponse
    {
        return $this->newsletterService->getCountStatus($request->status);
    }

    public function start(StartNewsletterRequest  $request) : JsonResponse
    {
        $contestants = Contestant::whereHas('application', function (Builder $builder) use($request){
           $builder->whereHas('status', function (Builder  $builder) use ($request){
                $builder->where('status', $request->status);
           });
        })->get();

        foreach ($contestants as $contestant){
            $this->newsletterService->start($contestant->id, 1);
        }
        return response()->json(['message' => 'Рассылка успешно создана']);
    }

}
