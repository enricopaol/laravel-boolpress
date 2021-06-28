<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>Ciao Enrico!</h1>

    <p>Ti confermiamo che è stato creato un nuovo post correttamente!</p>

    <h2>Info:</h2>

    <ul>
        <li>Creato il: {{ $mail_info->created_at }}</li>
        <li>Titolo: {{ $mail_info->title }}</li>
        <li>Contenuto: {{ $mail_info->content }}</li>
    </ul>

</body>
</html>