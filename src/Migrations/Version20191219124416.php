<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191219124416 extends AbstractMigration
{
  public function getDescription() : string
  {
      return '';
  }

  public function up(Schema $schema) : void
  {
      // this up() migration is auto-generated, please modify it to your needs
      $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

      $this->addSql('CREATE TABLE new_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

      $this->addSql('CREATE TABLE new_option_property (new_option_id INT NOT NULL , property_id INT NOT NULL , INDEX IDX_AB856D7AA7C41D6F (new_option_id) , INDEX IDX_AB856D7A549213EC (property_id) , PRIMARY KEY (new_option_id , property_id ) )
      DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB') ;

      $this->addSql('ALTER TABLE new_option_property ADD CONSTRAINT FK_AB856DAA7C41D6F FOREIGN KEY (new_option_id)
      REFERENCES new_option (id) ON DELETE CASCADE') ;

      $this->addSql('ALTER TABLE new_option_property ADD CONSTRAINT FK_AB856DA549213EC FOREIGN KEY (property_id)
      REFERENCES property (id) ON DELETE CASCADE') ;


  }

  public function down(Schema $schema) : void
  {
      // this down() migration is auto-generated, please modify it to your needs
      $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

      $this->addSql('ALTER TABLE new_option_proerty DROP FOREIGN KEY FK_AB856DAA7C41D6F');

      $this->addSql('DROP TABLE new_option') ;

      $thid->addSql('DROP TABLE new_option_proerty')

  }
}
