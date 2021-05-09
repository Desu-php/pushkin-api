@component('mail::message')

    <h1>Заявка с сайта - отправлено роботом</h1>
    <dl>
        <dt style="font-weight: bold">Область/Регион:</dt>
            <dd>{{ $application->region->name }}</dd>
        <dt style="font-weight: bold">Город:</dt>
            <dd>{{ $application->city->name }}</dd>
        <dt style="font-weight: bold">Образовательное учереждение:</dt>
            <dd>{{ $application->educationalInstitution->name }}</dd>
        @if ($application->teacher->last_name)
            <dt style="font-weight: bold">Педагог, подготовившей участника:</dt>
                <dd>Фамилия: {{ $application->teacher->last_name }}</dd>
                <dd>Имя: {{ $application->teacher->first_name }}</dd>
                <dd>Отчество: {{ $application->teacher->patronymic }}</dd>
                <dd>Тел.: {{ $application->teacher->phone }}</dd>
                <dd>email: {{ $application->teacher->email }}</dd>
        @endif
        <dt style="font-weight: bold">Конкурс:</dt>
            <dd>{{ $application->contest->title }}</dd>
        <dt style="font-weight: bold">Возраст.группа:</dt>
            <dd>{{ $application->ageGroup->title }}</dd>
        <dt style="font-weight: bold">Название работы (тема):</dt>
            <dd>{{ $application->theme->title }}</dd>
        <dt style="font-weight: bold">Участники:</dt>
            @foreach ($application->contestants as $contestant)
                <dd>Фамилия: {{ $contestant->last_name }}</dd>
                <dd>Имя: {{ $contestant->first_name }}</dd>
                <dd>Отчество: {{ $contestant->patronymic }}</dd>
                <dd>Тел.: {{ $contestant->phone }}</dd>
                <dd>email: {{ $contestant->email }}</dd>
            @endforeach
        @if ($application->contest->has_video)
            <dt style="font-weight: bold">Ссылка на видео</dt>
            <dd>{{ $application->linkContestWork }}</dd>
        @endif
    </dl>

    С уважением,
    Оргкомитет Пушкинского Фестиваля детского и юношеского творчества «Руслан и Людмила»
    Наш сайт - https://pushkin-volga.ru
@endcomponent
