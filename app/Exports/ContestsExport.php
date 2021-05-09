<?php

namespace App\Exports;

use App\Exports\Sheets\ContestsAgeGroupSheet;
use App\Models\AgeGroup;
use App\Models\Application;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ContestsExport implements WithMultipleSheets
{
    use Exportable;

    protected $contestId;

    public function __construct($contestId)
    {
        $this->contestId = $contestId;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $ageGroups = AgeGroup::where('contest_id', '=', $this->contestId)->get();

        $sheets = [];

        foreach ($ageGroups as $ageGroup) {
            $applications = Application::with([
                'contestants',
                'educationalInstitution',
                'theme',
            ])->where('age_group_id', $ageGroup->id)->where('status_id', 4)->get();

            if ($applications->count() > 0) {
                $sheets[] = new ContestsAgeGroupSheet($ageGroup, $applications);
            }
        }



        return $sheets;
    }
}
