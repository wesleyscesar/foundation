<?php

function getConexao()
{
    try {
        return new \PDO("mysql:host=localhost;dbname=foundation", "root", "t2ic0l02"); // CONEXÃO COM O BD
    } catch (\PDOException $e) {
        die("não foi possivel estabelecer a conexão");
    }
}