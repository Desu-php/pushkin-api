<?php
namespace App\Exports\Sheets;

use App\Models\AgeGroup;
use App\Models\Application;
use App\Models\Contestant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ContestsAgeGroupSheet implements FromView, ShouldAutoSize,  WithTitle
{
    protected $ageGroup;
    protected $applications;

    public function __construct(AgeGroup $ageGroup, $applications)
    {
        $this->ageGroup = $ageGroup;
        $this->applications = $applications;
    }

    public function view(): View
    {
        return view('exports.contestApplications', [
            'applications' => $this->applications,
            'ageGroup' => $this->ageGroup,
        ]);
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return $this->ageGroup->title;
    }
}
