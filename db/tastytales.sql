-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS tastytales CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar o banco de dados
USE tastytales;

-- Tabela de tipos de usuários
CREATE TABLE `users_types` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Tabela de usuários
CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `idType` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `photo` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_users_users_types1_idx` (`idType`),
    CONSTRAINT `fk_users_users_types1` FOREIGN KEY (`idType`) REFERENCES `users_types` (`id`)
);

-- Tabela de categorias de receitas
CREATE TABLE `categories` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Tabela de receitas
CREATE TABLE `recipes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `idCategory` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `preparationMethod` TEXT NOT NULL,
    `preparationTime` VARCHAR(50) NOT NULL,
    `image` VARCHAR(255) DEFAULT NULL,
    `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updatedAt` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `deletedAt` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_recipes_categories_idx` (`idCategory`),
    CONSTRAINT `fk_recipes_categories` FOREIGN KEY (`idCategory`) REFERENCES `categories`(`id`)
);


INSERT INTO users_types (description)
VALUES 
    ('Administrador'),
    ('Usuário');
    
INSERT INTO users (idType, name, email, password, photo)
VALUES (1, 'MaBre', 'maribrenda@gmail.com', '$2y$10$tBPXRnFpHqZkmOetvu1lq.gGGwaf9DgsXR6p4XQunSKVzuMB8Mc4m', NULL);
    
    SELECT * FROM users ORDER BY id DESC;
