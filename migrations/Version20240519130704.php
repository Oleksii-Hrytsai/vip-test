<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240519130704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create products table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (
            id INT AUTO_INCREMENT NOT NULL, 
            code INT NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            type VARCHAR(255) NOT NULL, 
            price DOUBLE NOT NULL, 
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            PRIMARY KEY(id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE product');
    }
}
