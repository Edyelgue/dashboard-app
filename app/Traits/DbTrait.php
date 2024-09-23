<?php
namespace App\Traits;
use App\Traits\PDO;

trait DbTrait
{
    const BANCO = '/database/database.sqlite';

    public static function conectarDB()
    {
        $diretorio_raiz = dirname(__DIR__);
        $caminho_banco = realpath($diretorio_raiz . '/' . self::BANCO);

        $pdo = new PDO("sqlite:$caminho_banco");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}