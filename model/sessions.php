<?php

declare(strict_types = 1);


function write_into_session(string $value_name, string $value)
{
    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    $_SESSION[$value_name] = $value;
    session_write_close();
}


function write_into_session_and_go_to(string $path, string $value_name, string $value)
{
    write_into_session($value_name, $value);
    header("Location: {$path}");
    exit();
}


function session_message(string $session_parameter, string $paragraph_class)
{
             
    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!empty($_SESSION[$session_parameter]))
    {
        echo "<p class='{$paragraph_class}'>" . $_SESSION[$session_parameter] . "</p>";
        unset($_SESSION[$session_parameter]);
    }

    session_write_close();
}


function check_session_parameter(string $path, string $session_parameter, bool $unset_parameter = false)
{
    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if(empty($_SESSION[$session_parameter]))
    {
        header("Location: {$path}");
        exit();            
    }

    if($unset_parameter)
    {
        unset($_SESSION[$session_parameter]);
    }

    session_write_close();
}


function clear_session()
{
    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    session_unset();
    session_write_close();
}