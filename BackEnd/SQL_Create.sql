CREATE TABLE Customer
(
  Email VARCHAR(30) NOT NULL, CHECK (Email LIKE '%@%.com'),
  Phone_Number INT NOT NULL, CHECK (Phone_Number LIKE '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'),
  First_Name VARCHAR(15) NOT NULL, 
  Last_Name VARCHAR(15) NOT NULL,
  UserName VARCHAR(10) NOT NULL,
  Password VARCHAR(10) NOT NULL, 
  Birth_Date DATE NOT NULL,
  Loyalty_Points INT NOT NULL, CHECK(Loyalty_Points >=0),
  PRIMARY KEY (UserName),

);


CREATE TABLE Product
(
  Product_Name VARCHAR(30) NOT NULL,
  PID INT NOT NULL,
  Price INT NOT NULL, CHECK(Price >=0),
  Description VARCHAR(50) NOT NULL, DEFAULT 'No item description',
  Quantity INT NOT NULL, CHECK(Quantity>=0),
  Category VARCHAR(30) NOT NULL, CHECK (Category IN ('Mod', 'Atomizer', 'Battery', 'Liquid', 'Booster', 'Coil', 'Pod')),
  Popularity FLOAT NOT NULL, CHECK(Popularity BETWEEN 1.0 and 10.0),
  PRIMARY KEY (PID)
);

CREATE TABLE Orders
(
  OrderID INT NOT NULL,
  Status VARCHAR(15) NOT NULL,
  Date DATE NOT NULL,
  ID INT NOT NULL,
  PRIMARY KEY (OrderID),
  FOREIGN KEY (UserName) REFERENCES Customer(UserName)
);

CREATE TABLE Cart
(
  Total_Amount INT NOT NULL,
  PID INT NOT NULL,
  OrderID INT NOT NULL,
  PRIMARY KEY (PID, OrderID),
  FOREIGN KEY (PID) REFERENCES dbo.Product(PID),
  FOREIGN KEY (OrderID) REFERENCES dbo.Orders(OrderID)
);


ALTER TABLE dbo.Customer
ADD CONSTRAINT check_Age CHECK (DATEDIFF(year, Birth_Date, GETDATE()) >= 18);

BULK INSERT EPL343.dbo.Customer
FROM 'G:\My Drive\UCY\UNIVERSITY(5TH semester)\EPL343\Big fucking project\epl343.winter23.team9\CustomerData.csv'
WITH
(
    FIELDTERMINATOR = ',',  -- Change to '\t' if your fields are tab-separated
    ROWTERMINATOR = '\r\n',   -- Windows-style newline '\r\n' might be needed
    FIRSTROW = 2,
    TABLOCK
);

ALTER TABLE Customer
ADD CONSTRAINT check_Age CHECK (DATEDIFF(year, Birth_Date, GETDATE()) >= 18);
