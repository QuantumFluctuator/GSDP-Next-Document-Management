CREATE TABLE [dbo].[Table1]
(
	[DocId] INT NOT NULL PRIMARY KEY,
	[DocName] VARCHAR(20) NOT NULL,
	[Edit Date] DATE NOT NULL,
	[Author] VARCHAR(15) NOT NULL,
	[Rating] DECIMAL(2, 1) DEFAULT 0,
	[Tags] VARCHAR(10) 


)
