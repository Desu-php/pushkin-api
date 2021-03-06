<?php


namespace App\Services;


use App\Models\ApplicationStatus;
use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class NewsletterService
{

    public function __construct()
    {
        $this->newsletter = new Newsletter();
    }

    public function pagination($status = ''): JsonResponse
    {
        $newsletter = Newsletter::with([
            'status',
            'contestant'
        ]);

        $newsletter = $this->status($newsletter, $status);

        return response()->json($newsletter->paginate());
    }

    public function getAll($status = ''): JsonResponse
    {
        $newsletter = Newsletter::with([
            'status',
            'contestant'
        ]);

        $newsletter = $this->status($newsletter, $status);

        return response()->json($newsletter->get());
    }

    public function getByStatus($statusId, $status = ''): JsonResponse
    {
        $newsletter = Newsletter::with([
            'status',
            'contestant'
        ])->where('status_id', $statusId);

        $newsletter = $this->status($newsletter, $status);

        return response()->json($newsletter->get());
    }

    public function getCountStatus($status = ''): JsonResponse
    {

        $statuses = ApplicationStatus::whereNotNull('description')->get();
        $results = [];
        foreach ($statuses as $status) {
            $newsletters = Newsletter::with('status');
            $newsletters = $this->status($newsletters, $status->status);
            $temps = [];
            foreach ($newsletters->get() as $newsletter) {
                if (!in_array($newsletter->status->status, $temps)) {
                    $results[$status->description][$newsletter->status->status] = [
                        'count' => 1,
                        'id' => $newsletter->status->id,
                        'title' => $newsletter->status->title,
                    ];
                    $temps[] = $newsletter->status->status;
                } else {
                    $results[$status->description][$newsletter->status->status]['count']++;
                }
            }
            $results[$status->description]['status'] = $status->status;
        }

        return response()->json($results);
    }

    public function start($contestantId, $statusId)
    {
        $newletter = Newsletter::firstOrCreate(
            ['contestant_id' => $contestantId],
            ['status_id' => $statusId]
        );
    }

    private function status($newsletter, $status)
    {
        if (!empty($status)) {
            $newsletter->whereHas('contestant.application.status', function (Builder $builder) use ($status) {
                $builder->where('status', $status);
            });
        }
        return $newsletter;
    }

}
