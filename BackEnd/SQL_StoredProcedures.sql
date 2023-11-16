USE DB CREATE PROC spSIGNUP @Email VARCHAR(30),
@Phone_Number VARCHAR(8),
@First_Name VARCHAR(30),
@Last_Name VARCHAR(30),
@UserName VARCHAR(30),
@Passwd VARCHAR(20),
@Birth_Date DATE,
AS IF EXISTS (
    SELECT *
    FROM CUSTOMER
    WHERE UserName = @UserName
) BEGIN PRINT 'Error: Username already exists'
END
ELSE BEGIN
INSERT INTO [dbo].CUSTOMER
VALUES(
        @Email,
        @Phone_Number,
        @First_Name,
        @Last_Name,
        @UserName,
        @Passwd,
        @Birth_Date
    );
END
GO CREATE PROC spLOGIN @UserName VARCHAR(30),
    @Password VARCHAR(20) AS IF EXISTS (
        SELECT *
        FROM CUSTOMER
        WHERE UserName = @UserName
            AND Passwd = @Password
    ) BEGIN PRINT 'Login successful'
END
ELSE BEGIN PRINT 'Error: Invalid username or password'
END