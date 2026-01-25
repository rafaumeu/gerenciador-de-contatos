# 📇 Contact Manager

![License](https://img.shields.io/badge/license-MIT-blue.svg?style=for-the-badge&logoScale=20)
[![Bob](https://github.com/rafaumeu/gerenciador-de-contatos/actions/workflows/lint.yml/badge.svg)](https://github.com/rafaumeu/gerenciador-de-contatos/actions/workflows/lint.yml)
![PHP](https://img.shields.io/badge/php-8.2+-777BB4.svg?style=for-the-badge&logo=php&logoColor=white&logoScale=20)
![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)

**Contact Manager** is a simple and efficient solution for organizing your personal and professional contacts. Designed with a clean architecture in mind, it serves as a robust example of a PHP application without heavy frameworks.

## ✨ Features

- **📇 Contact Operations**: Create, Read, Update, and Delete (CRUD) contacts easily.
- **🔍 Modern Search**: Quickly find contacts by name or email.
- **🔐 Military-Grade Security**: AES-256 encryption for sensitive data (Email & Phone).
- **👁️ Privacy Mode**: Blur/Hide sensitive info by default with password unlock.
- **🛡️ Robust Auth**: Middleware protection, Session management & Secure Logout.
- **🤖 Automated**: Full CI/CD pipeline for code quality ensuring every commit is pristine.

## 🚀 Getting Started

### Prerequisites

- **PHP 8.2+**
- **Composer**
- **Git**

### Installation

1.  Clone the repository:
    ```bash
    git clone https://github.com/rafaumeu/gerenciador-de-contatos.git
    cd gerenciador-de-contatos
    ```

2.  **Environment Setup**:
    Copy the example environment file and generate your encryption key:
    ```bash
    cp .env.example .env
    # Generate a secure key
    php -r "echo base64_encode(openssl_random_pseudo_bytes(32));"
    # Paste the key into your .env file at ENCRYPTION_KEY=...
    ```

3.  Install dependencies:
    ```bash
    composer install
    ```

4.  **Docker (Recommended)**:
    Start the application containers:
    ```bash
    docker compose up -d --build
    ```
    Access at http://localhost:8000.

5.  **Manual Setup (Alternative)**:
    Run the migrations and start the server:
    ```bash
    php database/migration.php
    php -S localhost:8000 -t public
    ```

6.  **Seed Database (Optional)**:
    Populate with test data (Admin + 5 encrypted contacts):
    ```bash
    docker compose exec app php database/seeder.php
    ```    git clone https://github.com/rafaumeu/gerenciador-de-contatos.git
    cd gerenciador-de-contatos
    ```

2.  Install dependencies:
    ```bash
    composer install
    ```

3.  Run the application (Development Mode):
    ```bash
    php -S localhost:8000 -t public
    ```

## 🛠️ Tech Stack

- **Language**: PHP 8.2+
- **Architecture**: Framework-agnostic, Clean Architecture principles.
- **Storage**: SQLite (Dev) / MySQL (Prod).
- **Tooling**: Composer, PHPUnit, Laravel Pint.

## 📂 Project Structure

```
gerenciador-de-contatos/
├── App/                # Domain Logic
│   ├── Controllers/    # Request Handlers
│   └── Models/         # Data Models
├── Core/               # Framework Kernel
│   ├── Database.php    # DB Connection (Singleton)
│   └── Model.php       # Base Model
├── config/             # Configuration files
├── database/           # SQLite file & Migrations
├── public/             # Web Root (Entry Point)
├── views/              # Blade/HTML Templates
├── tests/              # PHPUnit Tests
└── vendor/             # Composer Dependencies
```

## 🤝 Contributing

We strictly follow the [**GitHub Flow**](CONTRIBUTING.md).

1.  **Fork** the project.
2.  Create your feature branch (`git checkout -b feature/amazing-feature`).
3.  Commit your changes following **Conventional Commits** (`feat: add new filter`).
4.  Push to the branch.
5.  Open a **Pull Request**.

## 👨‍💻 Author

<div align="center">
<img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/30784471?v=4" width="100px;" alt=""/>

Made with 💜 by **[Rafael Dias Zendron](https://github.com/rafaumeu)**

[![Linkedin Badge](https://img.shields.io/badge/-Rafael-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/rafael-dias-zendron/)](https://www.linkedin.com/in/rafael-dias-zendron/)
[![Gmail Badge](https://img.shields.io/badge/-mmmarckos@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:mmmarckos@gmail.com)](mailto:mmmarckos@gmail.com)
</div>
