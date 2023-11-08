--create customer table
CREATE TABLE [dbo].CUSTOMER (
  Email VARCHAR(30) NOT NULL,
  CHECK (Email LIKE '%@%.com'),
  Phone_Number INT NOT NULL,
  CHECK (
    Phone_Number LIKE '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'
  ),
  First_Name VARCHAR(15) NOT NULL,
  Last_Name VARCHAR(15) NOT NULL,
  UserName VARCHAR(20) NOT NULL,
  Password VARCHAR(10) NOT NULL,
  Birth_Date DATE NOT NULL,
  Loyalty_Points INT NOT NULL,
  CHECK(Loyalty_Points >= 0),
  CONSTRAINT [PK_CUSTOMER] PRIMARY KEY ([UserName] ASC)
);

--create product table
CREATE TABLE [dbo].PRODUCT (
  Product_Name VARCHAR(30) NOT NULL,
  PID INT NOT NULL,
  Price INT NOT NULL,
  CHECK(Price >= 0),
  Description VARCHAR(50) NOT NULL,
  DEFAULT 'No item description',
  Quantity INT NOT NULL,
  CHECK(Quantity >= 0),
  Category VARCHAR(30) NOT NULL,
  CHECK (
    Category IN (
      'Mod',
      'Atomizer',
      'Battery',
      'Liquid',
      'Booster',
      'Coil',
      'Pod'
    )
  ),
  Popularity FLOAT NOT NULL,
  CHECK(
    Popularity BETWEEN 1.0
    and 10.0
  ),
  CONSTRAINT [PK_PRODUCT] PRIMARY KEY ([PID] ASC)
);

--create orders table
CREATE TABLE [dbo].ORDERS (
  OrderID INT NOT NULL,
  Status VARCHAR(15) NOT NULL,
  Date DATE NOT NULL,
  ID INT NOT NULL,
  UserName VARCHAR(20) NOT NULL,
  CONSTRAINT [PK_ORDERS] PRIMARY KEY ([OrderID] ASC)
);

--create cart table
CREATE TABLE [dbo].CART (
  Total_Amount INT NOT NULL,
  PID INT NOT NULL,
  Quantity INT NOT NULL,
  UserName VARCHAR(20) NOT NULL,
);

--add foreign key for orders(Customer UserName)
ALTER TABLE
  [dbo].ORDERS WITH CHECK
ADD
  CONSTRAINT [FK_ORDERS_CUSTOMER] FOREIGN KEY ([UserName]) REFERENCES [dbo].CUSTOMER ([UserName])
GO
  --add foreign key for cart(Product id)
ALTER TABLE
  [dbo].CART WITH CHECK
ADD
  CONSTRAINT [FK_CART_PRODUCTS] FOREIGN KEY ([PID]) REFERENCES [dbo].PRODUCT ([PID])
GO
  --add foreign key for cart(Customer Username)
ALTER TABLE
  [dbo].CART WITH CHECK
ADD
  CONSTRAINT [FK_CART_CUSTOMER] FOREIGN KEY ([UserName]) REFERENCES [dbo].CUSTOMER ([UserName])
GO
  --makes foreign key(UserName) of cart unique
ALTER TABLE
  [dbo].CART WITH CHECK
ADD
  CONSTRAINT [UNQ_UserName] UNIQUE ([UserName])
GO
ALTER TABLE
  dbo.Customer
ADD
  CONSTRAINT check_Age CHECK (DATEDIFF(year, Birth_Date, GETDATE()) >= 18);

BULK
INSERT
  [dbo].PRODUCT
FROM
  '.\Product.csv' WITH (
    FIELDTERMINATOR = ',',
    -- Change to '\t' if your fields are tab-separated
    ROWTERMINATOR = '\r\n',
    -- Windows-style newline '\r\n' might be needed
    FIRSTROW = 2,
    TABLOCK
  );

BULK
INSERT
  [dbo].Customer
FROM
  '.\Customer.csv' WITH (
    FIELDTERMINATOR = ',',
    -- Change to '\t' if your fields are tab-separated
    ROWTERMINATOR = '\r\n',
    -- Windows-style newline '\r\n' might be needed
    FIRSTROW = 2,
    TABLOCK
  );