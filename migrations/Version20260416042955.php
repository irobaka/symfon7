<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260416042955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make slug and timestamps not nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE starship SET slug = id, updated_at = arrived_at, created_at = arrived_at");

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship ALTER slug SET NOT NULL');
        $this->addSql('ALTER TABLE starship ALTER created_at SET NOT NULL');
        $this->addSql('ALTER TABLE starship ALTER updated_at SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE starship ALTER slug DROP NOT NULL');
        $this->addSql('ALTER TABLE starship ALTER created_at DROP NOT NULL');
        $this->addSql('ALTER TABLE starship ALTER updated_at DROP NOT NULL');
    }
}
