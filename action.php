<?php
session_start();

require_once "db.php";

function check_autorize($log, $pass)
{
   // global $users;
   $users = get_users();
    // return array_key_exists($log, $users) && $pass == $users[$log]['pass'];
    if (array_key_exists($log, $users) && $pass == $users[$log]['pass']) {
        $_SESSION['authorized'] = 1;
        $_SESSION['login'] = $log;
        return true;
    }
    return false;
}

function add_user($login, $password)
{
    $users = get_users();
    if (check_log($login)) {
        return false;
    } else {
        $users[$login] = ["pass" => $password, 'role' => 'user'];
        update_users($users);
        $_SESSION['authorized'] = 1;
        $_SESSION['login'] = $login;
        return true;
    }
}

function check_log($log)
{
    $users = get_users();
    return array_key_exists($log, $users);
}

function check_admin($log, $pass)
{
    //global $users;
    $users = get_users();
    //echo $users[$log]['role'];
    return check_autorize($log, $pass) && $users[$log]['role'] == 'admin';
}

function check_role($log, $pass)
{
    //global $users;
    $users = get_users();
    return check_autorize($log, $pass) ? $users[$log]['role'] : false;
}

function name($a, $b)
{ // функция, определяющая способ сортировки (по названию столицы)
    if ($a["capital"] < $b["capital"]) {
        return -1;
    } elseif ($a["capital"] == $b["capital"]) {
        return 0;
    } else {
        return 1;
    }

}

function area($a, $b)
{ // функция, определяющая способ сортировки (по названию столицы)
    if ($a["area"] < $b["area"]) {
        return -1;
    } elseif ($a["area"] == $b["area"]) {
        return 0;
    } else {
        return 1;
    }
}

function population($a, $b)
{ // функция, определяющая способ сортировки (по населению)
    if ($a["population"]["2000"] + $a["population"]["2010"] < $b["population"]["2000"] + $b["population"]["2010"]) {
        return -1;
    } elseif ($a["population"]["2000"] + $a["population"]["2010"] == $b["population"]["2000"] + $b["population"]["2010"]) {
        return 0;
    } else {
        return 1;
    }

}

function sorting($how_to_sort)
{
    global $countries;
    uasort($countries, $how_to_sort);
}

function out_countries()
{
    global $countries;
    // делаем переменную $countries глобальной
    $arr_out = [];
    $arr_out[] = "<table  class=\"table table-hover\">";
    $arr_out[] = "<tr><td>№</td><td>Страна</td><td>Столица</td><td>Площадь</td><td>Население за 2000 год</td><td>Население за 2010 год</td><td>Среднее население</td></tr>";
    foreach ($countries as $country) {
        static $i = 1;
        //статическая глобальная переменная-счетчик
        $str = "<tr>";
        $str .= "<td>" . $i . "</td>";
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                $str .= "<td>$value</td>";
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<td>$v</td>";
                }

            }

        }
        $str .= "<td>" . (array_sum($country['population']) / count($country['population'])) . "</td>";
        $str .= "</tr>";
        $arr_out[] = $str;
        $i++;
    }
    $arr_out[] = "</table>";
    return $arr_out;
}

function out_arr_search(array $arr_index = null)
{
    global $countries; // делаем переменную $countries глобальной
    $arr_out = array();
    $arr_out[] = "<table  class=\"table table-hover \">";
    $arr_out[] = "<tr><td>№</td><td>Country</td><td>
    Capital</td><td>Area</td><td>Population for 2000</td><td>Population for 2010</td><td>Average population</td></tr>";
    foreach ($countries as $index => $country) {
        if ($arr_index != null && in_array($index, $arr_index)) {
            static $i = 1;
            $str = "<tr>" . "<td>" . $i . "</td>";
            foreach ($country as $key => $value) {
                if (!is_array($value)) {
                    $str .= "<td>$value</td>";
                } else {
                    foreach ($value as $k => $v) {
                        $str .= "<td>$v</td>";
                    }
                }
            }
            $str .= "<td>" . (array_sum($country['population']) / count($country['population'])) . "</td></tr>";
            $arr_out[] = $str;
            $i++;
        }
    }
    $arr_out[] = "</table>";
    return $arr_out;
}

function out_search($data)
{
    global $countries; // делаем переменную $countries глобальной
    $arr_index = [];
    foreach ($countries as $country_number => $country) {
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                if (stristr($value, $data)) {
                    $arr_index[] = $country_number;
                }
            } else {
                foreach ($value as $k => $v) {
                    if (stristr($v, $data) || strstr($k, $data)) {
                        $arr_index[] = $country_number;
                    }
                }
            }
        }
    }
    return out_arr_search(array_unique($arr_index));
}

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function update_users($users)
{

}

function get_users()
{
    global $users;
    return $users;    
}