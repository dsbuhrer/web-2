# AS34C-Desenv_Web-Server-N41
Projeto Desenvolvimento Web

Allan Rogrigues Clementino,	RA 2163187
Davi Silva Buhrer,			RA 2374102
Vitor Iago Huggler,			RA 2384329

# Fluxo de Caixa Parametrizável

## Criar uma aplicação para controle de fluxo de caixa, utilizando a tecnologia PHP.

<h4 align="center"> 
	🚧  PHP Select 🚀 Em construção...  🚧
</h4>

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[XAMPP para LINUX](https://www.apachefriends.org/pt_br/download_success.html).
Além disto é bom ter um editor para trabalhar com o código, utilizamos o [VSCode](https://code.visualstudio.com/)

### Instalando o XAMPP

Pode ser feito a instalação via linha de commando.

```bash
# Acesse a pasta de Downloads e abra as propriedades do arquivo xampp-linux-VERSAO-installer.
# Em permissões marcar a opção "Permitir execução do arquivo como um programa"

# Acesse a pasta de Download no terminal/cmd
$ cd Downloads/

# Execute o arquivo baixado
$ sudo ./xampp-linux-x64-VERSAO-installer.run

# Na tela do instalador é só clicar em "Avançar" e aguardar a instalação.
# Por fim, mantenha a opção Launch XAMPP e Finalize.
```
### 🎲 Rodando Virtual Servers

1.No painel de controle do Xampp, clique no botão "Explorer" (Explorer/Open Folder) na linha do Apache. Isso abrirá a pasta onde os arquivos do servidor estão localizados.

2.Navegue até a pasta apache, depois conf e encontre o arquivo httpd.conf. Abra esse arquivo em um editor de texto.

3.No arquivo httpd.conf, procure pela seção que contém configurações de Virtual Hosts. Essa seção geralmente está comentada por padrão.

4.Descomente a linha que contém Include conf/extra/httpd-vhosts.conf removendo o caractere # no início da linha. Isso permitirá a inclusão das configurações de virtual hosts.

5.Salve o arquivo httpd.conf e feche-o.

6.Navegue até a pasta apache, depois conf, e agora abra o arquivo extra/httpd-vhosts.conf.

7.No arquivo httpd-vhosts.conf, adicione as configurações para o seu virtual host. Aqui está um exemplo básico:

8.Certifique-se de substituir meu-virtual-server.local pelo nome do seu servidor virtual e C:/caminho/do/meu-projeto pelo caminho absoluto da pasta raiz do seu projeto.

9.Salve o arquivo httpd-vhosts.conf e feche-o.

10.Reinicie o Apache no painel de controle do XAMPP.

11.Abra o arquivo C:\Windows\System32\drivers\etc\hosts como administrador (ou use um editor de texto com privilégios de administrador).

12.No final do arquivo hosts, adicione uma linha para mapear o nome do servidor virtual para o endereço IP local (127.0.0.1). Por exemplo:
<VirtualHost *:80>
    ServerName meu-virtual-server.local
    DocumentRoot "C:/caminho/do/meu-projeto"
    <Directory "C:/caminho/do/meu-projeto">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

13.Certifique-se de substituir meu-virtual-server.local pelo nome do seu servidor virtual e C:/caminho/do/meu-projeto pelo caminho absoluto da pasta raiz do seu projeto.

14.Salve o arquivo httpd-vhosts.conf e feche-o.

15.Reinicie o Apache no painel de controle do XAMPP.

16.Abra o arquivo C:\Windows\System32\drivers\etc\hosts como administrador (ou use um editor de texto com privilégios de administrador).

17.No final do arquivo hosts, adicione uma linha para mapear o nome do servidor virtual para o endereço IP local (127.0.0.1). Por exemplo: 127.0.0.1    meu-virtual-server.local

18.Agora você pode acessar seu virtual server digitando meu-virtual-server.local no seu navegador. Certifique-se de que o XAMPP esteja em execução e seu projeto esteja na pasta especificada no DocumentRoot.

### 🎲 Rodando o Back End (servidor)

# Caso a janela do XAMPP esteja fechada, seguir o seguinte passo.

```bash
# Acesse a pasta de /opt/lampp no terminal/cmd
$ cd ~
$ cd ../../opt/lampp/

# Execute o comando abaixo
$ sudo ./manager-linux-x64.run
```

# O servidor inciará na porta:80 - acesse <http://localhost/web-servidor/AS34C-Desenv_Web-Server-N41/>

### 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- [PHP](https://www.php.net/)

### Instalar as dependencias do composer.json
No terminal ou prompt de comando, execute o seguinte comando para instalar as dependências do projeto: composer install
Após a conclusão da instalação, você terá uma pasta vendor no seu projeto, que contém as dependências do Composer.

### Instalando o MySQL Workbench

O download pode ser feito no site [MYSQL Workbench](https://dev.mysql.com/downloads/workbench/), seguindo o passa-a-passo de instalação [Installation](https://dev.mysql.com/doc/workbench/en/wb-requirements.html).

Após o download e configuração, precisamos criar um Server e executar os scripts base para o projeto.

### 🎲 Configurando o Banco de Dados no projeto
Abra o arquivo Http/Controllers/DatabaseController.php do projeto e localize as seguintes variáveis:

MYSQL_HOST: É o nome ou endereço do servidor MySQL onde seu banco de dados está hospedado. Exemplo: "localhost" se estiver rodando localmente.
MYSQL_USER: É o nome de usuário do MySQL que será usado para acessar o banco de dados.
MYSQL_PASSWORD: É a senha do usuário do MySQL.
MYSQL_DB_NAME: É o nome do banco de dados que você deseja se conectar. Este pode ser deixado como "fluxo" caso opte por criar o banco de dados com o algoritmo que está no passo "Criando o Banco de Dados"

Preencha essas variáveis com os dados corretos do seu servidor MySQL.
Salve o arquivo DatabaseController.php.

Agora você deve ter as dependências instaladas usando o Composer e as informações corretas do servidor MySQL preenchidas. Você pode prosseguir criando o banco de dados.

### 🎲 Criando o Banco de Dados
Executar um por vez.

```SQL
-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.33 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para fluxo
CREATE DATABASE IF NOT EXISTS `fluxo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `fluxo`;

-- Copiando estrutura para tabela fluxo.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela fluxo.categorias: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
	(1, 'categoria 1', 'descricao'),
	(2, 'categoria 2', 'descricao');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Copiando estrutura para tabela fluxo.lancamentos
CREATE TABLE IF NOT EXISTS `lancamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_lancamento` varchar(50) NOT NULL,
  `valor` varchar(50) NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `pagamento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pagamento` (`pagamento_id`) USING BTREE,
  KEY `categoria_lancamento` (`categoria_id`) USING BTREE,
  CONSTRAINT `lancamentos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `lancamentos_ibfk_2` FOREIGN KEY (`pagamento_id`) REFERENCES `pagamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela fluxo.lancamentos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `lancamentos` DISABLE KEYS */;
INSERT INTO `lancamentos` (`id`, `data_lancamento`, `valor`, `descricao`, `tipo`, `categoria_id`, `pagamento_id`) VALUES
	(1, '2022-03-22', '2.39', 'Descrição teste', 'Rendimento', 2, 1),
	(2, '2023-11-30', '0.05', 'Descrição teste', 'Despesa', 1, 1),
	(3, '2002-02-20', '1937.74', 'Descrição teste', 'Despesa', 2, 2);
/*!40000 ALTER TABLE `lancamentos` ENABLE KEYS */;

-- Copiando estrutura para tabela fluxo.pagamentos
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela fluxo.pagamentos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` (`id`, `nome`) VALUES
	(1, 'Boleto'),
	(2, 'Credito'),
	(3, 'Debito'),
	(4, 'Pix');
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;

-- Copiando estrutura para tabela fluxo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela fluxo.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `name`, `password`) VALUES
	(1, 'admin', 'teste'),
	(2, 'funcionario', '1234');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

```
### Acesso ao sistema
Foram criados dois usuários para acessar o sistema:
Usuário 1
Login: admin
Senha: teste

Usuário 2
Login: funcionario
Senha: 1234
----------------------------------------------------------------------------------------------------------

As funções atribuidas a cada integrante do grupo foram relacionadas ao nível de conhecimento e/ou praticidade em cada uma das aplicações. Segue listado abaixo as funções de cada membro:

- Allan Clementino: Documentação de configuração e instalação do software: este documento deve mostrar os requisitos para instalação, quais arquivos de configuração devem ser atualizados, como o banco de dados deve ser criado, etc;

- Davi Buhrer: Uso de um sistema de rotas (URL transparente) e o uso do padrão MVC (melhoria do Trabalho 1 para separar a lógica (validações, controle, etc.), a estrutura de dados (entidades, consultas, etc.) e o HTML (apenas apresentação do conteúdo)). 

- Vitor Huggler: Banco de Dados MySQL / MariaDB / Postgres / Outro via PDO;

Em suma, todos os integrantes se ajudaram em tarefas determinadas, tomando a frente em certos casos para aumentar a produtividade.

Este programa em particular ainda não possui a funcionalidade de registro de novos usuários, sendo necessário utilizar o login pré-definido como "admin" e senha "1234" para acessar o sistema.

Para cadastrar um novo lançamento financeiro, é necessário ter previamente cadastrado pelo menos um método de pagamento e uma categoria. Essa funcionalidade permite uma melhor organização e precisão nas informações financeiras do usuário.

É possível apagar métodos de pagamentos e categorias sem que afetem os lançamentos criados com tais métodos de pagamentos e categorias.