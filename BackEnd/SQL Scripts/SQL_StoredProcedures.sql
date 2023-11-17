CREATE PROC spSIGNUP @Email VARCHAR(30),
@Phone_Number VARCHAR(8),
@First_Name VARCHAR(30),
@Last_Name VARCHAR(30),
@UserName VARCHAR(30),
@Passwd VARCHAR(20),
@Birth_Date DATE,
AS IF EXISTS (
    SELECT *
    FROM [dbo].CUSTOMER
    WHERE [UserName] = @UserName
) BEGIN PRINT 'Error: Username already exists'
END
ELSE BEGIN
SET @Password=HASHBYTES('SHA2_256', @Passwd);
INSERT INTO [dbo].CUSTOMER
VALUES (
        @Email,
        @Phone_Number,
        @First_Name,
        @Last_Name,
        @UserName,
        @Password,
        @Birth_Date,
        CONVERT(INT, '0')
    );
END
GO CREATE PROC spLOGIN @UserName VARCHAR(30),
    @Passwd VARCHAR(20) AS IF EXISTS (
        SELECT *
        FROM [dbo].CUSTOMER
        WHERE [UserName] = @UserName
            AND [Passwd] = HASHBYTES('SHA2_256', @Passwd)
    ) BEGIN PRINT 'Login successful'
END
ELSE BEGIN PRINT 'Error: Invalid username or password'
END

  CREATE PROCEDURE spProduct (@ProductArg CHAR(50)=NULL) 
AS BEGIN 
	SELECT	[Product_Name], Price
	FROM	[dbo].[PRODUCT]
	WHERE	Category = @ProductArg
END
GO

  CREATE PROCEDURE spProducts
AS BEGIN 
	SELECT	[Product_Name], Price
	FROM	[dbo].[PRODUCT]
	WHERE	Category = 'Mod' OR Category='Atomizer' OR Category='Battery' OR Category = 'Coil'
END
GO