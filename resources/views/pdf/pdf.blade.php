<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    html {
        height: 100%;
    }

    body {
        font-family: "Times New Roman", Times, serif;
        width: 100%;
        margin-left: -50px;
        margin-right: -50px;
        margin-top: -50px;
        margin-bottom: -50px;
        background-image: url(img.png); /* Путь к фоновому рисунку */
        background-repeat: no-repeat;
        padding: 0;
        background-position: center;
        background-size: 100% 100%; /* Масштабируем фон */
    }

    .container {
        margin-left: auto;
        margin-right: auto;
        margin-top: 370px;
        font-weight: bold;
    }

    .p-list {
        font-size: 10px;
        text-align: center;
    }

    .are-awarded {
        text-align: center;
        margin-top: 20px;
    }

    .are-awarded-title {
        font-size: 14px;
    }

    .are-awarded-nam {
        font-size: 18px;
        margin-top: 15px;
    }

    .are-awarded-school, .are-awarded-teacher {
        font-size: 10px;
    }

    .are-awarded-school {
        margin-top: 10px;
    }

    .are-awarded-teacher {
        margin-top: 10px;
    }

    .administrations {
        display: inline-block;
max-width: 200px;
        width: 200px;
        /*width: 100%;*/
        text-align: center;
        /*display: -webkit-box;*/
        /*display: flex;*/
        /*-webkit-box-pack: center;*/
        /*justify-content: center;*/
        margin-top: 50px;
        /*margin-left: 500px;*/
        /*width: 500px;*/
    }
    .admin-text{
        font-size: 11px;
        font-weight: bold;
    }
    .mb-10{
        margin-bottom: 20px;
    }
    .admin-text span{
        font-size: 9px;
        margin-top: 20px;
    }
    .padding{
        padding-left: 120px;
    }
    .pt{
        padding-top: 5px;
    }
    .admin-text br{
        margin: 5px 0;
    }
    .admin-text p{
        font-size: 9px;
        padding-bottom: 0;
        margin-top: 5px;
        margin-bottom: 5px;
        font-weight: bold;
    }
</style>
<body>
<div class="container">
    <div class="p-list">
        <div>за участие в конкурсе {{$contestant->application->contest->title}}</div>
        <div>III-ого Пушкинского городского Фестиваля</div>
        <div>детского и юношеского творчества</div>
        <div>«Руслан и Людмила».</div>
    </div>
    <div class="are-awarded">
        <p class="are-awarded-title">награждаются:</p>
        <div class="are-awarded-name">{{$contestant->first_name.' '.$contestant->last_name}}</div>
        <div class="are-awarded-school">{{$contestant->application->educationalInstitution->name}}</div>
        <div class="are-awarded-teacher">{{$contestant->application->teacher->post}}: {{$contestant->application->teacher->first_name}} {{$contestant->application->teacher->last_name}} {{$contestant->application->teacher->patronymic}}</div>
    </div>
    <table style="width: 100%; margin-top: 50px; padding: 0 0 0 80px" >
        <thead>
        </thead>
        <tbody>
        <tr valign="top" class="admin-text">
            <td style="width: 50%" class="mb-10">Председатель Оргкомитета Фестиваля</td>
            <td class="padding">Кузнецов А. М.
                <p>(Председатель ТО ВТОО «СХР»)</p>
            </td>
        </tr>
        <tr valign="top" class="admin-text">
            <td style="width: 50%">Учредитель и Организатор Фестиваля</td>
            <td class="padding">Кузнецов А. М.
                <p>(Директор КРЦ «Ноосфера)</p>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
