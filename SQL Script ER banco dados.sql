CREATE SCHEMA IF NOT EXISTS `VendasCliente` DEFAULT CHARACTER SET utf8 ;
USE `VendasCliente` ;

-- -----------------------------------------------------
-- Table `VendasCliente`.`DocVendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VendasCliente`.`DocVendas` (
  `DocId` INT NOT NULL AUTO_INCREMENT,
  `DocData` DATETIME NULL,
  `DocNro` VARCHAR(50) NULL,
  `DocTotal` DOUBLE NULL,
  `DocCEP` VARCHAR(8) NULL,
  `DocRua` VARCHAR(255) NULL,
  `DocComplemento` VARCHAR(100) NULL,
  `DocBairro` VARCHAR(100) NULL,
  `DocLocalidade` VARCHAR(100) NULL,
  `DocUF` VARCHAR(2) NULL,
  PRIMARY KEY (`DocId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VendasCliente`.`Fornecedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VendasCliente`.`Fornecedores` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `FornecedorNome` VARCHAR(60) NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VendasCliente`.`Produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VendasCliente`.`Produtos` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(100) NULL,
  `ProdutoReferenca` VARCHAR(8) NOT NULL,
  `ProdutoPreco` DOUBLE NULL,
  `ProdutoIdFornecedor` INT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `ProdutoReferenca_UNIQUE` (`ProdutoReferenca` ASC),
  INDEX `ProdutoFornecedor_idx` (`ProdutoIdFornecedor` ASC),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC),
  CONSTRAINT `ProdutoFornecedor`
    FOREIGN KEY (`ProdutoIdFornecedor`)
    REFERENCES `VendasCliente`.`Fornecedores` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `VendasCliente`.`ItenVendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VendasCliente`.`ItenVendas` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `ProdutoId` VARCHAR(8) NULL,
  `ProdutoPreco` DOUBLE NULL,
  `ProdutoCantidade` INT NULL,
  `ProdutoDocId` INT NOT NULL,
  PRIMARY KEY (`Id`, `ProdutoDocId`),
  INDEX `ItenProduto_idx` (`ProdutoId` ASC),
  UNIQUE INDEX `Id_UNIQUE` (`Id` ASC),
  CONSTRAINT `ItenProduto`
    FOREIGN KEY (`ProdutoId`)
    REFERENCES `VendasCliente`.`Produtos` (`ProdutoReferenca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO `fornecedores` (`Id`, `FornecedorNome`) VALUES (NULL, 'Fornecedor A');
INSERT INTO `fornecedores` (`Id`, `FornecedorNome`) VALUES (NULL, 'Fornecedor B');
INSERT INTO `fornecedores` (`Id`, `FornecedorNome`) VALUES (NULL, 'Fornecedor C');
INSERT INTO `fornecedores` (`Id`, `FornecedorNome`) VALUES (NULL, 'Fornecedor D');

INSERT INTO `produtos` (`Id`, `Nome`, `ProdutoReferenca`, `ProdutoPreco`, `ProdutoIdFornecedor`) VALUES (NULL, 'PRODUTO A', 'P0001', '10.50', '1');
INSERT INTO `produtos` (`Id`, `Nome`, `ProdutoReferenca`, `ProdutoPreco`, `ProdutoIdFornecedor`) VALUES (NULL, 'PRODUTO B', 'P0002', '15.50', '2');
INSERT INTO `produtos` (`Id`, `Nome`, `ProdutoReferenca`, `ProdutoPreco`, `ProdutoIdFornecedor`) VALUES (NULL, 'PRODUTO C', 'P0003', '20.50', '3');
INSERT INTO `produtos` (`Id`, `Nome`, `ProdutoReferenca`, `ProdutoPreco`, `ProdutoIdFornecedor`) VALUES (NULL, 'PRODUTO D', 'P0004', '25.50', '4');
