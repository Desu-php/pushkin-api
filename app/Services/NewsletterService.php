<?php


namespace App\Services;


use App\Models\Newsletter;
use Illuminate\Http\JsonResponse;

class NewsletterService
{

    public function __construct()
    {
        $this->newsletter = new Newsletter();
    }

    public function pagination(): JsonResponse
    {
        return response()->json(Newsletter::with([
            'status',
            'contestant'
        ])->paginate());
    }

    public function getAll(): JsonResponse
    {
        return response()->json(Newsletter::with([
            'status',
            'contestant'
        ])->get());
    }

    public function getByStatus($statusId): JsonResponse
    {
        return response()->json(Newsletter::with([
            'status',
            'contestant'
        ])->where('status_id', $statusId)->get());
    }

    public function getCountStatus(): JsonResponse
    {
        $newsletters = Newsletter::with('status')->get();
        $results = [];
        $temps = [];
        foreach ($newsletters as $newsletter) {
            if (!in_array($newsletter->status->status, $temps)) {
                $results[$newsletter->status->status] = [
                    'count' => 1,
                    'id' => $newsletter->status->id,
                    'title' => $newsletter->status->title,
                ];
                $temps[] = $newsletter->status->status;
            } else {
                $results[$newsletter->status->status]['count']++;
            }
        }
        return response()->json($results);
    }

    public function start($contestantId, $statusId)
    {
        $newletter =  Newsletter::firstOrCreate(
            ['contestant_id' => $contestantId],
            ['status_id' => $statusId]
        );
    }

}
