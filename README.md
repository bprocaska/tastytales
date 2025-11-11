# TastyTales

**TastyTales** é um projeto web desenvolvido em PHP que oferece uma experiência personalizada para os amantes da gastronomia. A aplicação permite interação com receitas, sugestões, perfis de usuários e uma interface administrativa.

## 📁 Estrutura do Projeto

tastytales/
├── api/                         # Endpoints e configuração da API
├── css/                         # Arquivos de estilo (CSS)
├── db/                          # Scripts de banco de dados
├── html/
│   └── adm/                     # Páginas HTML administrativas
├── imagens/                     # Recursos visuais (imagens)
├── source/                      # Código-fonte principal (MVC)
│   ├── Core/                    # Componentes principais do framework
│   ├── Models/                  # Modelos de dados
│   ├── Web/                     # Controladores Web
│   └── WebService/              # Serviços e APIs
├── vendor/                      # Pacotes do Composer
│   ├── coffeecode/router/       # Sistema de rotas
│   ├── firebase/php-jwt/        # JWT para autenticação
│   └── league/plates/           # Sistema de templates Plates
├── views/                       # Arquivos de visualização (views)
│   ├── admin/                   # Views para a área administrativa
│   ├── app/                     # Views para o app em geral
│   └── web/                     # Views do site público
├── .gitignore                   # Arquivo Git para ignorar arquivos
├── .htaccess                    # Configurações do Apache
├── composer.json               # Dependências e autoload do Composer
└── index.php                    # Página inicial do projeto

## 🚀 Funcionalidades

- Página de login e cadastro de usuários
- Perfil de usuário editável
- Página de sugestões gastronômicas
- Interface administrativa para gestão de conteúdo
- Sistema de assinatura/cartão (indicando possíveis planos pagos)
- Página "Sobre Nós"
- Integração com banco de dados

## 🛠 Tecnologias Utilizadas

- PHP
- HTML5 & CSS3
- MySQL
- Apache (mod_rewrite via `.htaccess`)
- Composer (para gerenciamento de dependências)

## 🗃 Banco de Dados

O arquivo `db/tastytales.sql` contém o script necessário para criar as tabelas e estrutura inicial do banco de dados. Utilize uma ferramenta como **phpMyAdmin** ou **MySQL CLI** para importá-lo.

