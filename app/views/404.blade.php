<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 error</title>  
    <style>

        * {margin: 0; padding: 0;}

        body {
            background: #606b82;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #FEFEFE;
            font-size: 14px;
        }

        section {
            width: 100%;
            max-width: 400px;
            margin: 200px auto;
            padding: 20px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        a, a:visited {
            color: #B6BDCA;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            font-size: 4em;
            line-height: 1em;
            font-weight: bold;
        }

        h2 {
            font-weight: normal;
            font-size: 2em;
            margin-bottom: 20px;
        }

        ul li {
            display: inline;
            margin: 0 1.2em;
        }

        p {
            margin: 1em 0;
            color: #555;
            line-height: 2em;
        }
    </style> 
</head>

<body>

<section>
<h1>Lỗi 404</h1>
<h2>Không có trang bạn cần tìm</h2>
{{ HTML::link('/', 'Quay về trang chủ') }}
</section>

</body>

</html>
