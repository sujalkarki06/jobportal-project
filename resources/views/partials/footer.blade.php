<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Footer</title>
    <style type="text/css">
        /* Apply styles to the body to make it a flex container */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Set minimum height to 100% of the viewport height */
            margin: 0; /* Remove default margin */
        }

        /* Apply styles to push footer to the bottom */
        .content {
            flex: 1; /* Fill remaining vertical space */
        }

        .footer {
            border-top: solid 2px royalblue;
            margin-top: auto; /* Push footer to the bottom */
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content">
        <!-- Your page content goes here -->
    </div>
    
    <div class="footer">
        <strong>©2024 | FindOne </strong>
    </div>
</body>
</html>
