<?php


namespace App\Services;

use App\Models\Application;
use App\Models\Contestant;
use App\Models\Theme;
use App\Models\EducationalInstitution;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Auth;
use Illuminate\Http\Request;

class ApplicationService
{
    public function __construct()
    {
        $this->application = new Application();
    }

    public function pagination(): JsonResponse
    {
        return response()->json(Application::with(
            [
                'contestants',
                'contest',
                'status',
                'region',
                'city',
                'ageGroup',
                'theme',
                'user',
                'teacher',
                'files',
                'educationalInstitution',
            ]
        )->paginate());
    }

    public function get($id): JsonResponse
    {
        return response()->json(Application::with(
            [
                'contestants',
                'contest',
                'status',
                'region',
                'city',
                'ageGroup',
                'theme',
                'user',
                'teacher',
                'files',
                'educationalInstitution',
            ]
        )->where('id', '=', $id)->first());
    }

    public function getAll(): JsonResponse
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return response()->json(Application::with(
                [
                    'contestants',
                    'contest',
                    'status',
                    'region',
                    'city',
                    'ageGroup',
                    'theme',
                    'user',
                    'teacher',
                    'files',
                    'educationalInstitution',
                ]
            )->orderBy('id', 'desc')->get());
        } else {
            return response()->json(Application::with(
                [
                    'contestants',
                    'contest',
                    'status',
                    'region',
                    'city',
                    'ageGroup',
                    'theme',
                    'user',
                    'teacher',
                    'files',
                    'educationalInstitution',
                ]
            )->where('user_id', '=', $user->id)->orderBy('id', 'desc')->get());
        }
    }

    public function store(array $validated): JsonResponse
    {

        $application = new Application();
        $application->region_id = $validated['region'];
        $application->city_id = $validated['city'];

        $educationalInstitution = new EducationalInstitution();
        $educationalInstitution->name = $validated['educationalInstitution'];
        $educationalInstitution->city_id = $validated['city'];
        $educationalInstitution->save();
        $application->educational_institution_id = $educationalInstitution->id;


        $application->contest_id = $validated['contest'];
        $application->age_group_id = $validated['ageGroup'];

        if (is_numeric($validated['theme'])) {
            $application->theme_id = $validated['theme'];
        } else {
            $theme = new Theme();
            $theme->title = $validated['theme'];
            $theme->age_group_id = 0;
            $theme->save();
            $application->theme_id = $theme->id;
        }

        if ($validated['teacher']) {
            $teacher = new Teacher($validated['teacher']);
            $teacher->save();
            $application->teacher_id = $teacher->id;
        }

        $application->user_id = 1;
        $application->status_id = 1;
        if (array_key_exists('linkContestWork', $validated)) {
            $application->linkContestWork = $validated['linkContestWork'];
        }
        if (array_key_exists('comment', $validated)) {
            $application->comment = $validated['comment'];
        }

        $application->save();

        foreach ($validated['contestants'] as $validContestant) {
            $contestant = new Contestant($validContestant);
            $contestant->application_id = $application->id;
            $contestant->save();
        }
        return response()->json(['message' => 'Ваша заявка принята', 'data' => $application]);
    }


    public function update(Application $application, array $validated): JsonResponse
    {
        $application->region_id = $validated['region']['id'];
        $application->city_id = $validated['city']['id'];

        $educationalInstitution = EducationalInstitution::find($validated['educationalInstitution']['id']);
        $educationalInstitution->name = $validated['educationalInstitution']['name'];
        $educationalInstitution->city_id = $validated['educationalInstitution']['city_id'];
        $educationalInstitution->save();

        $teacher = Teacher::find($validated['teacher']['id']);
        $teacher->update($validated['teacher']);

        $application->contest_id = $validated['contest']['id'];
        $application->ageGroup_id = $validated['ageGroup']['id'];

        if ($validated['theme']['age_group_id'] == 0) {
            $application->theme()->title = $validated['theme']['title'];
        } else {
            $application->theme_id = $validated['theme']['id'];
        }

        if (array_key_exists('linkContestWork', $validated)) {
            $application->linkContestWork = $validated['linkContestWork'];
        }

        if (array_key_exists('comment', $validated)) {
            $application->comment = $validated['comment'];
        }

        foreach ($validated['contestants'] as $validContestant) {
            $contestant = Contestant::find($validContestant['id']);
            $contestant->update($validContestant);
        }

        $application->save();

        return response()->json(['message' => 'Заявка успешно обновлена', 'data' => $application]);
    }

    public function delete(Application $application)
    {
        $application->delete();
        return response()->json(['message' => 'Заявка успешно удалена']);
    }

    public function updateStatus(Application $application, Request $request): JsonResponse
    {
        $application->status_id = $request['id'];
        $application->save();
        return response()->json(['message' => 'Статус изменен', 'data' => $application]);
    }

    public function updateUser(Application $application, Request $request)
    {
        $application->user_id = $request['id'];
        $application->save();
        return response()->json(['message' => 'Пользователь изменен', 'data' => $application]);
    }
}
