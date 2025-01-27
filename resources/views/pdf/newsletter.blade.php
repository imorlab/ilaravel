<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 5mm;
            size: A4 portrait;
        }
        .preview-container {
            width: 100%;
            margin: 0;
            padding: 0;
            transform: scale(0.3);
            transform-origin: top center;
        }
        body {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100% !important;
            /* border-collapse: collapse !important; */
        }
        td {
            padding: 5px !important;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="preview-container">
        {!! $content !!}
    </div>
</body>
</html>
