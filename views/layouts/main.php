<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Php test task</title>
    <style>
        body {
            line-height: 22px;
            justify-content: center;
            color: #062e55;
            background-color: #5ed2bb;
        }

        section {
            margin: 1%;
            padding: 2%;
            border: 2px dotted white;
            border-radius: 10px;
            font-size: 20px;
        }

        form {
            width: 80%;

        }

        h3 {
            text-align: center;
            font-size: 20px;
            color: #051045;
        }

        .form_submit {
            margin: 10px 100px;
        }

        .section_image {
            display: inline-block;
            border: 1px solid #333;
            padding: 5px;
            margin: 10px 0 5px 5px;
            background: #f0f0f0;
        }

        .content a {
            padding: 10px 10px;
            margin: 10px;
            display: inline-block;
            text-decoration: none;
            color: #26a5a1;
            box-shadow: 0 0 2px 1px #bdbdbd;
            background: linear-gradient(180deg, #FCFFE6 50%, #E6E6E6 100%);
        }

        input {
            margin: 5px 27px;
            height: 40px;
            width: 200px;
            font-size: 14px;
        }

        .submit {
            width: 120px;
        }

        textarea {
            width: 600px;
            height: 200px;
        }

        a:hover {
            cursor: pointer;
            box-shadow: 0 0 4px 2px #056a5c;
        }

        .error {
            color: red;
            font-size: 14px;
            margin: 5px 60px;
        }
    </style>

</head>
<body>
<h3>Articles</h3>

<div class="content">
    <a href="list_articles">Show List article</a>
</div>
<div class="content">
    <a href="add_article">Add article</a>
</div>

{{content}}

<div class="content">
    <a href="./">Home</a>
</div>
</body>
</html>


