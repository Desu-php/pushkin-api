<table style="border: 1px solid #000000">
    <thead>
        <tr></tr>
        <tr>
            <th></th>
            <th></th>
            <th><b>Третий городской Фестиваль детского и <br> юношеского творчества «Руслан и Людмила».</b></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th><b>{{ $ageGroup->contest->title }}</b></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>{{ $ageGroup->title }}</th>
            <th></th>
            <th></th>
            <th colspan="5"><b>Критерии оценки</b></th>
        </tr>
        <tr>
            <th></th>
            <th><b>№ п/п</b></th>
            <th><b>Фамилия имя отчество</b></th>
            <th><b>Название произведения</b></th>
            <th><b>Учреждение</b></th>
            <th><b>Соблюдение <br> норм русского <br> языка и стиля в <br> сочинении</b></th>
            <th><b>Раскрытие темы <br> (соответствие темы <br> и содержания, <br> логичность <br> выводов)</b></th>
            <th><b>Стройность <br> композиционного <br> решения</b></th>
            <th><b>Образность, <br> выразительность <br>и точность<br> использования<br> языковых <br>средств</b></th>
            <th><b>Творческая <br> самостоятельность <br> изложения</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($applications as $application)
            @foreach ($application->contestants as $contestant)
                <tr>
                    <td></td>
                    <td>{{ $application->id }}</td>
                    <td>{{ $contestant->last_name . ' ' . $contestant->first_name . ' ' . $contestant->patronymic }}</td>
                    <td>{{ $application->theme->title }}</td>
                    <td>{{ $application->educationalInstitution->name }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
