<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190111223548 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO country (name,code) VALUES ('United States','US'), ('Belgium','BE'), ('Switzerland','CH'), ('Germany','DE'), ('Spain','ES'), ('France','FR'), ('Croatia','HR'), ('Italy','IT'), ('Luxembourg','LU'), ('Mexico','MX');");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE country');
    }
}
