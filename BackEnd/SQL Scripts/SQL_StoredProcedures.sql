CREATE PROCEDURE spSIGNUP @Email VARCHAR(30),
@Phone_Number VARCHAR(8),
@First_Name VARCHAR(30),
@Last_Name VARCHAR(30),
@UserName VARCHAR(30),
@Passwd VARCHAR(20),
@Birth_Date DATE
AS 
IF EXISTS (
  SELECT *
  FROM [dbo].CUSTOMER
  WHERE [UserName] = @UserName
) BEGIN PRINT 'Error: Username already exists'
END
ELSE BEGIN
SET @Passwd = HASHBYTES('SHA2_256', @Passwd);
INSERT INTO [dbo].CUSTOMER
VALUES (
    @Email,
    @Phone_Number,
    @First_Name,
    @Last_Name,
    @UserName,
    @Passwd,
    @Birth_Date,
    CONVERT(INT, '0')
  );
END
GO 

CREATE PROCEDURE spLOGIN @UserName VARCHAR(30),
  @Passwd VARCHAR(20) 
  AS 
  IF EXISTS (
    SELECT *
    FROM [dbo].CUSTOMER
    WHERE [UserName] = @UserName
      AND [Passwd] = HASHBYTES('SHA2_256', @Passwd)
  ) BEGIN PRINT 'Login successful'
END
ELSE BEGIN PRINT 'Error: Invalid username or password'
END
GO 

CREATE PROCEDURE spProduct (@ProductArg CHAR(50) = NULL) 
AS 
BEGIN
SELECT [Product_Name],
  Price
FROM [dbo].[PRODUCT]
WHERE Category = @ProductArg
END
GO 

CREATE PROCEDURE spProducts 
AS 
BEGIN
SELECT [Product_Name],
  Price
FROM [dbo].[PRODUCT]
WHERE Category = 'Mod'
  OR Category = 'Atomizer'
  OR Category = 'Battery'
  OR Category = 'Coil'
END
GO 

CREATE PROCEDURE spAddProduct @Product_Name VARCHAR(50),
  @Product_ID INT,
  @Price FLOAT,
  @Description VARCHAR(500),
  @Stock INT,
  @Category VARCHAR(30),
  @Image_path VARCHAR(200)
  AS 
  IF EXISTS (
    SELECT *
    FROM [dbo].[PRODUCT]
    WHERE [Product_ID] = @Product_ID
  ) BEGIN PRINT 'Error: Product ID already exists' RETURN
END
IF @Stock < 0 BEGIN PRINT 'Error: Stock cannot be negative' RETURN
END
IF @Price < 0 BEGIN PRINT 'Error: Price cannot be negative' RETURN
END
IF NOT (@Category='Mod' OR @Category='Atomizer' OR @Category='Battery' OR @Category='Liquid' OR @Category='Booster' OR @Category='Coil' OR @Category='Pod')
BEGIN PRINT 'Error: Invalid category' RETURN
END
BEGIN
INSERT INTO [dbo].PRODUCT
VALUES (
    @Product_Name,
    @Product_ID,
    @Price,
    @Description,
    @Stock,
    @Category,
    @Image_path
  );
  PRINT 'Success: Product added'
END
GO

CREATE PROCEDURE spDeleteProduct @Product_ID INT
AS
BEGIN
IF NOT EXISTS (
    SELECT *
    FROM [dbo].[PRODUCT]
    WHERE [Product_ID] = @Product_ID
  ) BEGIN PRINT 'Error: Product ID does not exist.' RETURN
END
DELETE FROM [dbo].[PRODUCT]
    WHERE [Product_ID] = @Product_ID
PRINT 'Success: Product deleted'
END

CREATE PROCEDURE spEditProduct
  @p_Name VARCHAR(50),
  @p_ID INT,
  @p_Price FLOAT,
  @p_Description VARCHAR(500),
  @p_Stock INT,
  @p_Category VARCHAR(30),
  @p_Image_path VARCHAR(200)
  AS 
  BEGIN
  IF NOT EXISTS (
    SELECT *
    FROM [dbo].[PRODUCT]
    WHERE [Product_ID] = @Product_ID
  ) BEGIN PRINT 'Error: Product does not exist' RETURN
END
  EXEC spDeleteProduct @Product_ID=@p_ID;
  EXEC spAddProduct @Product_Name=@p_Name, @Product_ID=@p_ID, @Price=@p_Price, @Description=@p_Description, @Stock=@p_Stock, @Category=@p_Category, @Image_path=@p_Image_path;

END
GO