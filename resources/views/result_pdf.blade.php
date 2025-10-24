<!DOCTYPE html>
<html>
<head>
    <title>Xray Result PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
        pre { background: #eee; padding: 10px; }
    </style>
</head>
<body>
    <h1>Xray Result #{{ $record->id }}</h1>

    <p><strong>Created At:</strong> {{ $record->created_at }}</p>

    <h2>Result Data:</h2>
    <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>

</body>
</html>
