<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
    <h1>Hello {{$data['name']}}, You order number {{$data['orderNumber']}} has been created</h1>
    <P>Order has these products</P>
    <ul>
        @foreach ($data['products'] as $product)
            <li>{{$product}}</li>
        @endforeach
    </ul>
</body>
</html>
