<?php

namespace VeroEnv;

use CurupiraDoc\Escritor;

/**
 * 🦂 SCORPION: VeroEnv - O Cofre de Segredos
 * --------------------------------------------------------------------------
 * @author Sérgio Nahar <sergio.ac.nahar@gmail.com>
 * @package VeroEnv
 * 📜 @description Gerencia variáveis de ambiente (.env) obrigatoriamente na pasta /sys.
 * --------------------------------------------------------------------------
 */
class Vero
{
    /** @var array Armazena as variáveis carregadas */
    private static $variaveis = [];

    /**
     * ⚓ ICOARACI: carregar()
     * 📝 @description Lê o arquivo .env dentro da pasta /sys na raiz do projeto.
     * 📥 @param string $diretorioBase Caminho da raiz (ex: __DIR__)
     */
    public static function carregar(string $diretorioBase): void
    {
        // Define o caminho padrão para a pasta sys
        $caminhoSys = rtrim($diretorioBase, '/') . '/sys';
        $arquivo = $caminhoSys . '/.env';

        if (!file_exists($arquivo)) {
            // Se o arquivo não existir, o Curupira interrompe com um aviso visual
            die(Escritor::flashCard('erro', "<b>VeroEnv:</b> Arquivo .env não localizado em <u>{$caminhoSys}</u>."));
        }

        // Processamento seguro do arquivo
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($linhas as $linha) {
            if (strpos(trim($linha), '#') === 0) continue; // Ignora comentários

            if (strpos($linha, '=') !== false) {
                list($chave, $valor) = explode('=', $linha, 2);
                $chaveLimpa = trim($chave);
                $valorLimpo = trim($valor);

                self::$variaveis[$chaveLimpa] = $valorLimpo;
                putenv("{$chaveLimpa}={$valorLimpo}");
            }
        }
        
        // Auditoria: Registra que o ambiente foi carregado
        if (class_exists('\\CurupiraDoc\\Escritor')) {
            Escritor::registrarAcesso("VeroEnv::carregar (Pasta sys)");
        }
    }

    /**
     * ⚓ ICOARACI: get()
     * 📝 @description Recupera um valor do cofre.
     */
    public static function get(string $chave, $padrao = null)
    {
        return self::$variaveis[$chave] ?? (getenv($chave) ?: $padrao);
    }

    /**
     * 📝 @description Recupera um valor garantindo que seja um número inteiro (Ex: Portas).
     */
    public static function getInt(string $chave, int $padrao = 0): int
    {
        return (int) self::get($chave, $padrao);
    }
}
