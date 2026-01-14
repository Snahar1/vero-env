# vero-env
🔐 O Cofre de Segredos - Gerenciador de variáveis de ambiente (.env) para sistemas MVC.

O **VeroEnv** é o componente responsável pela gestão de variáveis de ambiente (.env) do **Ecossistema Scorpion**. Ele atua como um cofre blindado, garantindo que credenciais sensíveis (Base de Dados, APIs, Chaves de Criptografia) nunca fiquem expostas diretamente no código-fonte.

---

## ✨ Diferenciais Técnicos

- **Caminho Privado:** Configurado nativamente para buscar o arquivo `.env` dentro da pasta `/sys/` na raiz do projeto, isolando configurações sensíveis.
- **Fail-Fast com Estilo:** Caso o arquivo de configuração esteja ausente, ele aciona o **CurupiraDoc** para gerar um erro visual imediato e travar o sistema por segurança.
- **Recuperação Tipada:** Inclui métodos específicos como `getInt()` para garantir a integridade de dados numéricos (ex: portas de banco de dados).

## 📂 Estrutura de Pastas Recomendada
```text
projeto/
├── sys/           # Pasta de sistema (privada)
│   └── .env       # O seu cofre de segredos
└── index.php      # Entrada do sistema
```

## 🛠️ Instalação via Docas

No seu docas.json:
```
"require": {
    "snahar/vero-env": "1.0.0"
}
```

## 📖 Como Usar
1. Carregando o Cofre

No seu arquivo de entrada (ex: index.php), inicialize o Vero apontando para a raiz do projeto:

```
use VeroEnv\Vero;

// Ele buscará automaticamente em __DIR__ . '/sys/.env'
Vero::carregar(__DIR__);
```
2. Recuperando Valores

```
// Recupera uma string (com valor padrão se não existir)
$host = Vero::get('DB_HOST', 'localhost');

// Recupera garantindo que o retorno seja um número inteiro
$port = Vero::getInt('DB_PORT', 3306);
```

## 🤝 Dependências

    CurupiraDoc: Essencial para a exibição de alertas visuais em caso de falha no carregamento do ambiente.
   
---

Desenvolvido por Sérgio Nahar 🦂
