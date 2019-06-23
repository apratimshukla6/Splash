  create table users
  (
  ID int AUTO_INCREMENT,
  Username varchar(255),
  Email_ID varchar(255),
  Password varchar(255), 
  Wallet_ID bigint(11),
  PRIMARY KEY (ID)
  );
  
  create table currency
  (
  Currency_ID int AUTO_INCREMENT,
  API_Token varchar(255),
  ID int,
  Currency_Name varchar(255), 
  Currency_Amount bigint(12),
  Currency_Desc text,
  Type int,
  PRIMARY KEY (Currency_ID)
  );
  
  create table wallet
  (
  Record_No int AUTO_INCREMENT,
  ID int,
  Currency_ID int,
  Currency_Balance bigint(12),
  Wallet_ID bigint(11),
  PRIMARY KEY (Record_No)
  );
  
  create table balance
  (
  ID int,
  Account_Balance decimal(19,2),
  Symbol varchar(3),
  Total_Currency_Valuation decimal(19,2),
  PRIMARY KEY (ID)
  );
  
  create table currency_extra
  (
  Currency_ID int,
  Unit_Cost decimal(19,2),
  Currency_Symbol varchar(3),
  Currency_Valuation decimal(19,2),
  PRIMARY KEY (Currency_ID)
  );
  
  create table user_portfolio
  (
  ID int,
  Tier varchar(255),
  PRIMARY KEY (ID)
  );
  
  create table initiate_trade
  (
  Trade_ID int AUTO_INCREMENT,
  Initiator_Wallet_ID bigint(11),
  Initiator_Currency_ID int,
  Acceptor_Wallet_ID bigint(11),
  Acceptor_Currency_ID int,
  Initiator_Amount bigint(12),
  Acceptor_Amount bigint(12),
  Generated_Key varchar(255),
  Trade_Timestamp datetime,
  Trade_Status int,
  PRIMARY KEY (Trade_ID)
  );
  
  create table trade_records
  (
  Trade_ID int,
  Initiator_Wallet_ID bigint(11),
  Acceptor_Wallet_ID bigint(11),
  Trade_Result varchar(255),
  PRIMARY KEY (Trade_ID)
  );

  create table transfer_records
  (
  Transfer_ID int AUTO_INCREMENT,
  Payer_Wallet_ID bigint(11),
  Payee_Wallet_ID bigint(11),
  Currency_ID int,
  Transfer_Amount bigint(12),
  Transfer_Result varchar(255),
  Transfer_Time datetime,
  PRIMARY KEY (Transfer_ID)
  );
  