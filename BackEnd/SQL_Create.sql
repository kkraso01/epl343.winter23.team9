--create customer table
USE DB CREATE TABLE [dbo].CUSTOMER (
  Email VARCHAR(30) NOT NULL,
  CHECK (Email LIKE '%@%.com'),
  Phone_Number VARCHAR(8) NOT NULL,
  CHECK (
    Phone_Number LIKE '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'
  ),
  First_Name VARCHAR(30) NOT NULL,
  Last_Name VARCHAR(30) NOT NULL,
  UserName VARCHAR(30) NOT NULL,
  Passwd VARCHAR(20) NOT NULL,
  Birth_Date DATE NOT NULL,
  Loyalty_Points INT NOT NULL,
  CHECK(Loyalty_Points >= 0),
  CONSTRAINT [PK_CUSTOMER] PRIMARY KEY ([UserName] ASC)
);

--create product table
CREATE TABLE [dbo].PRODUCT (
  Product_Name VARCHAR(50) NOT NULL,
  Product_ID INT NOT NULL,
  Price INT NOT NULL,
  CHECK(Price >= 0),
  Description VARCHAR(50) NOT NULL DEFAULT 'No item description',
  Stock INT NOT NULL,
  CHECK(Stock >= 0),
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
  Popularity INT NOT NULL,
  CHECK(
    Popularity BETWEEN 1
    and 10
  ),
  Image_path VARCHAR(200),
  CONSTRAINT [PK_PRODUCT] PRIMARY KEY ([Product_ID] ASC)
);

--create orders table
CREATE TABLE [dbo].ORDERS (
  Order_ID INT NOT NULL,
  Status VARCHAR(15) NOT NULL,
  CHECK (
    Status IN (
      'Pending',
      'Ready for pickup',
      'Completed',
      'Cancelled',
      'In progress'
    )
  ),
  Date DATE NOT NULL,
  --FK
  UserName VARCHAR(30) NOT NULL,
  CONSTRAINT [PK_ORDERS] PRIMARY KEY ([Order_ID] ASC)
);

--create cart table
CREATE TABLE [dbo].CART (
  Total_Amount INT NOT NULL,
  Cart_ID INT NOT NULL,
  --FK
  UserName VARCHAR(30) NOT NULL,
  CONSTRAINT [PK_CART] PRIMARY KEY ([Cart_ID] ASC)
);

--Many to many tables

--create cart_product table
CREATE TABLE [dbo].CART_PRODUCT (
  Cart_Quantity INT NOT NULL,
  --FK
  Cart_ID INT NOT NULL,
  Product_ID INT NOT NULL,
  CONSTRAINT [PK_CART_PRODUCT] PRIMARY KEY ([Cart_ID],[Product_ID] ASC)
);

--create order_product table
CREATE TABLE [dbo].ORDER_PRODUCT (
  Order_Quantity INT NOT NULL,
  --FK
  Order_ID INT NOT NULL,
  Product_ID INT NOT NULL,
  CONSTRAINT [PK_ORDER_PRODUCT] PRIMARY KEY ([Order_ID],[Product_ID] ASC)
);

--FOREIGN KEYS
--add foreign key for orders(Customer UserName)
ALTER TABLE
  [dbo].ORDERS WITH CHECK
ADD
  CONSTRAINT [FK_ORDERS_CUSTOMER] FOREIGN KEY ([UserName]) REFERENCES [dbo].CUSTOMER ([UserName])
GO
  --add foreign key for cart(Customer Username)
ALTER TABLE
  [dbo].CART WITH CHECK
ADD
  CONSTRAINT [FK_CART_CUSTOMER] FOREIGN KEY ([UserName]) REFERENCES [dbo].CUSTOMER ([UserName])
GO

--add foreign key for cart_product
ALTER TABLE
  [dbo].CART_PRODUCT WITH CHECK
ADD
  CONSTRAINT [FK_CART_PRODUCT_CART] FOREIGN KEY ([Cart_ID]) REFERENCES [dbo].CART ([Cart_ID])
GO
ALTER TABLE
  [dbo].CART_PRODUCT WITH CHECK
ADD
  CONSTRAINT [FK_CART_PRODUCT_PRODUCT] FOREIGN KEY ([Product_ID]) REFERENCES [dbo].PRODUCT ([Product_ID])
GO

--add foreign key for order_product
ALTER TABLE
  [dbo].ORDER_PRODUCT WITH CHECK
ADD
  CONSTRAINT [FK_ORDER_PRODUCT_ORDER] FOREIGN KEY ([Order_ID]) REFERENCES [dbo].ORDERS ([Order_ID])
GO
  --makes foreign key(UserName) of cart unique
ALTER TABLE
  [dbo].ORDER_PRODUCT WITH CHECK
ADD
  CONSTRAINT [FK_ORDER_PRODUCT_PRODUCT] FOREIGN KEY ([Product_ID]) REFERENCES [dbo].PRODUCT ([Product_ID])
GO

BULK
INSERT
  [dbo].PRODUCT
FROM
  'C:\Users\asus\Documents\GitHub\epl343.winter23.team9\BackEnd\Data\ProductData.csv' WITH (
    FIELDTERMINATOR = ',',
    -- Change to '\t' if your fields are tab-separated
    ROWTERMINATOR = '\n',
    -- Windows-style newline '\r\n' might be needed
    FIRSTROW = 2,
    TABLOCK
  );

BULK
INSERT
  [dbo].Customer
FROM
  'C:\Users\asus\Documents\GitHub\epl343.winter23.team9\BackEnd\Data\Customer.csv' WITH (
    FIELDTERMINATOR = ',',
    -- Change to '\t' if your fields are tab-separated
    ROWTERMINATOR = '\n',
    -- Windows-style newline '\r\n' might be needed
    FIRSTROW = 2,
    TABLOCK
  );