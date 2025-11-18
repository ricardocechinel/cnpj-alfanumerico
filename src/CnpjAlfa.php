<?php

namespace RicardoCechinel\CnpjAlfanumerico;

class CnpjAlfa
{
    /**
     * Converte um caractere (número ou letra) no valor para cálculo.
     * Regra oficial: ASCII - 48
     */
    private static function charToValue(string $char): int
    {
        return ord(strtoupper($char)) - 48;
    }

    /**
     * Gera os pesos (da direita para a esquerda, 2 a 9, reiniciando após 9).
     */
    private static function generateWeights(int $length): array
    {
        $weights = [];
        $w = 2;

        for ($i = 0; $i < $length; $i++) {
            $weights[] = $w;
            $w++;
            if ($w > 9) $w = 2;
        }

        return array_reverse($weights); // direita → esquerda
    }

    /**
     * Calcula um dígito verificador (1º ou 2º)
     */
    private static function calcularDV(string $base): int
    {
        $chars = str_split($base);
        $values = array_map([self::class, 'charToValue'], $chars);

        $weights = self::generateWeights(count($values));

        $soma = 0;
        foreach ($values as $i => $v) {
            $soma += $v * $weights[$i];
        }

        $resto = $soma % 11;

        return ($resto === 0 || $resto === 1)
            ? 0
            : 11 - $resto;
    }

    /**
     * Gera os dois dígitos verificadores
     */
    public static function gerarDV(string $cnpj12): string
    {
        if (strlen($cnpj12) !== 12) {
            throw new \InvalidArgumentException("O CNPJ alfanumérico deve ter 12 caracteres.");
        }

        $dv1 = self::calcularDV($cnpj12);
        $dv2 = self::calcularDV($cnpj12 . $dv1);

        return "{$dv1}{$dv2}";
    }

    /**
     * Valida um CNPJ alfanumérico completo (14 caracteres)
     */
    public static function validar(string $cnpj14): bool
    {
        if (strlen($cnpj14) !== 14) {
            return false;
        }

        $base  = substr($cnpj14, 0, 12);
        $dvInformado = substr($cnpj14, 12, 2);

        return self::gerarDV($base) === $dvInformado;
    }

    /**
     * Gera um CNPJ alfanumérico válido aleatório
     */
    public static function gerarCnpj(): string
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = '';

        for ($i = 0; $i < 12; $i++) {
            $base .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $dv = self::gerarDV($base);

        return $base . $dv;
    }
}
