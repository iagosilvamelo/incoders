# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)


## Projeto Incoders

Projeto para teste de desenvolvimento php Incoders.

### .env

**MAIL_SERVER** - Servidor de email a ser utilizado.

**MAIL_USERNAME** - Conta de email a ser utilizada.

**MAIL_PASSWORD** - Senha da conta de email.

**MAIL_ATTACHMENTS** - Diretório onde serão armazenados os anexos.

**GUZZLEHTTP_ENDPOINT** - Endpoint da api que receberá os dados

**GUZZLEHTTP_TIMEOUT** - Timeout para resposta da api.

**ROUTE_TO_POST_DANFES** - Rota da api que irá receber os dados.


### Leitura dos emails

O projeto está configurado para ler apenas emails não lidos.
Para ler todos os email, deve efetuar a seguinte alteração em MailboxController.php:

**De:**

```
$mailsIds = self::mail()->searchMailbox('UNSEEN');
// $mailsIds = self::mail()->searchMailbox('ALL');
```

**Para:**


```
//$mailsIds = self::mail()->searchMailbox('UNSEEN');
$mailsIds = self::mail()->searchMailbox('ALL');
```

### Commands

**mailbox:check-messages** - Retorna quantos emails tem a ser lido

**mailbox:send-danfes** - Lê os email, extrai os dados e envia para api

### Routes

**/api/mailbox** - Retorna leitura dos emails

**/api/mailbox/{id}** - Retorna leitura de um email específico

**/api/danfe/verify-mail** - Efetua leitura dos emails, extrai os dados e retorna em json

**/api/danfe/send** - Efetua leitura dos emails, extrai os dados e envia para api

#### Thanks

Agradeço a oportunidade de participar do processo seletivo para a vaga.
Espero ter atendido aos requisitos solicitados.
Ficarei muito feliz em poder fazer parte da equipe Incoders.
