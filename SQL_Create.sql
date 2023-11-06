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
  FOREIGN KEY (PID) REFERENCES Product(PID),
  FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

-- Inserting data into Customer table
INSERT INTO Customer ( Email, Phone_Number, First_Name, Last_Name, UserName, Password, Birth_Date, Loyalty_Points) VALUES
('john.doe@example.com', 123456, 'John', 'Doe', 'johndoe', 'johnd123', '1985-02-15', 120),
('jane.smith@example.com', 234567, 'Jane', 'Smith', 'janesmith', 'janes123', '1990-06-09', 340),
('bob.jones@example.com', 345678, 'Bob', 'Jones', 'bobjones', 'bobj123', '1978-08-23', 220);

-- Inserting data into Product table
INSERT INTO Product (Product_Name, PID, Price, Description, Quantity, Category, Popularity) VALUES
('Widget A', 1, 1999, 'A useful widget', 50, 'Gadgets', 4.5),
('Gizmo B', 2, 2999, 'A fancy gizmo', 30, 'Gadgets', 3.8),
('Thing C', 3, 999, 'An essential thing', 100, 'Misc', 4.9);