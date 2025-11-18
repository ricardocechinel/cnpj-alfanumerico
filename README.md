# 🧾 CNPJ Alfanumérico — Biblioteca PHP

[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue)]()
[![Composer](https://img.shields.io/badge/Composer-ready-orange)]()

Biblioteca PHP para **validar**, **gerar dígitos verificadores (DV)** e **criar CNPJ alfanumérico válido**, seguindo rigorosamente as regras oficiais publicadas pelo **SERPRO** e pela **Instrução Normativa RFB nº 2.119/2022**.

Compatível com:

- PHP 7.4+  
- PHP Puro  
- CodeIgniter 4  
- Laravel  
- Qualquer projeto com PSR-4  

---

## 📦 Instalação

Via Composer:

```bash
composer require ricardocechinel/cnpj-alfanumerico
```

## 🧩 Como Funciona

O CNPJ Alfanumérico possui:
- 12 caracteres alfanuméricos
- 2 dígitos verificadores numéricos

Cálculo baseado em:
- Código ASCII (valor - 48)
- Pesos de 2 a 9 (da direita para a esquerda)
- Módulo 11

Toda a lógica segue os documentos oficiais do SERPRO.

### 🚀 Uso
✔ 1. Validar um CNPJ alfanumérico

```php
use RicardoCechinel\CnpjAlfanumerico\CnpjAlfa;

$cnpj = "12ABC34501DE35";

if (CnpjAlfa::validar($cnpj)) {
    echo "CNPJ válido!";
} else {
    echo "CNPJ inválido!";
}
```
### ✔ 2. Gerar os dígitos verificadores (DV)

```php
use RicardoCechinel\CnpjAlfanumerico\CnpjAlfa;

$base = "12ABC34501DE"; // 12 caracteres
$dv = CnpjAlfa::gerarDV($base);

echo $dv; // Exemplo: "35"
```

### ✔ 3. Gerar um CNPJ alfanumérico completo e válido

```php
use RicardoCechinel\CnpjAlfanumerico\CnpjAlfa;

$novo = CnpjAlfa::gerarCnpj();

echo $novo; // Exemplo: A9BC12XY34ZP08

```

### 📁 Estrutura do Projeto

```css
cnpj-alfanumerico/
 ├── src/
 │    └── CnpjAlfa.php
 ├── tests/
 ├── vendor/
 └── composer.json
```


