<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F4511E;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container img {
            width: 100px; /* Adjust the size as needed */
        }
        .container h1 {
            font-size: 3em;
            margin: 20px 0 10px 0;
        }
        .container p {
            font-size: 1.2em;
            margin: 0 0 20px 0;
        }
        .container button {
            background-color: white;
            color: #F4511E;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="umbrella-image-url.png" alt="Umbrella Image">
        <h1>COMING SOON</h1>
        <p>This page is under construction.</p>
        <button onclick="window.location.href='/'">GO HOME</button>
    </div>
</body>
</html>
