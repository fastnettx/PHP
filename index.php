<?php

function write_counter()
{
    if (isset($_COOKIE['сounter'])) {
        $counter = $_COOKIE['сounter'];
        $counter++;
        setcookie('сounter', $counter);
        return $counter;
    } else {
        setcookie('сounter', 1);
        return 1;
    }
}

function show_number_of_unidentified_user($number)
{
    setcookie('counter_data', date('d/m/Y H:i:s'));
    if ($number == 1) {
        echo 'Вы здесь только ' . set_red_style($number) . ' раз.';
    } else {
        echo 'Вы здесь уже ' . set_red_style($number) . end_check($number) .
            ' Ваш последний визит был ' . set_green_style($_COOKIE['counter_data'] . '.');
    }
}

function number_of_visits($user)
{
    $array_user = unserialize($_COOKIE[$user]);
    $array_user['counter']++;
    display_message($array_user['name'], $array_user['surname'], $array_user['age'], $array_user['counter'], $array_user['date']);
    $array_user['date'] = date('d/m/Y H:i:s');
    setcookie($user, serialize($array_user));
}

function check_user($name, $surname, $age)
{
    $user = strval($name . $surname . $age);
    if (isset($_COOKIE[$user])) {
        return true;
    } else {
        $array_user = array('name' => $name,
            'surname' => $surname,
            'age' => $age,
            'counter' => 1,
            'date' => date('d/m/Y H:i:s'),
        );
        setcookie($user, serialize($array_user));
        return false;
    }
}

function display_message($name, $surname, $age, $counter, $date)
{
    $year = 2020 - $age;
    echo 'Вы ' . $name . ' ' . $surname . ' и вы родились в ' . $year . ' году. Вы здесь уже ' .
        set_red_style($counter) . end_check($counter) . ' Ваш последний визит был ' .
        set_green_style($date) . '.';
}

function end_check($counter)
{
    $array = [2, 3, 4];
    if (($counter < 5 || $counter > 19) && in_array($counter % 10, $array)) {
        return ' раза.';
    } else {
        return ' раз.';
    }
}

function set_red_style($variable)
{
    return "<span class='red_color'>" . $variable . "</span>";
}

function set_green_style($variable)
{
    return "<span class='green_color'>" . $variable . "</span>";
}

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
            margin: 2%;
            padding: 2%;
            border: 2px dotted white;
            border-radius: 10px;
            font-size: 20px;
        }

        form {
            width: 60%;
            text-align: right;
        }

        h3 {
            text-align: center;
            font-size: 20px;
            color: #051045;
        }

        .form_submit {
            margin: 10px 40px;
        }

        input {
            margin: 10px;
            height: 40px;
            width: 180px;
            font-size: 14px;
        }

        .submit {
            width: 120px;
        }

        .result {
            font-size: 18px;
        }

        .red_color {
            color: red;
            font-weight: bold;
        }

        .green_color {
            color: green;
            font-style: italic;
        }

        .submit:hover {
            cursor: pointer;
            box-shadow: 0 0 5px 3px #056a5c;
        }
    </style>
</head>
<body>
<section>
    <h3>Форма идентификации пользователя</h3>
    <form method="post">
        <div><label for="name"> Имя </label>
            <input type="text" id="name" placeholder="Укажите имя" name="name" maxlength="20" required><br>
        </div>

        <div><label for="surname"> Фамилия </label>
            <input type="text" id="surname" placeholder="Укажите фамилию" name="surname" maxlength="30" required><br>
        </div>

        <div><label for="age"> Возраст </label>
            <input type="number" id="age" min="0" max="130" placeholder="Укажите возраст" name="age" required><br>
        </div>
        <div class="form_submit">
            <input class="submit" type="submit" name="show" value="Идентификация">
        </div>
    </form>
</section>
<section>
    <div class="result">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['show'])) {
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $age = trim($_POST['age']);
            if (!empty($name) && !empty($surname) && !empty($age)) {
                if (check_user($name, $surname, $age)) {
                    number_of_visits(strval($name . $surname . $age));
                } else {
                    display_message($name, $surname, $age, 1, date('d/m/Y H:i:s'));
                }
            } else {
                echo 'Данные заполнены не корректно, повторите ввод данных!';
            }

        } else {
            $counter = write_counter();
            show_number_of_unidentified_user($counter);
        }
        ?>
    </div>
</section>
</body>
</html>