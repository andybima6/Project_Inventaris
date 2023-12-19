-- Disable foreign key checks temporarily
EXEC sp_MSforeachtable 'ALTER TABLE ? NOCHECK CONSTRAINT ALL';

-- Database: `inventory`
USE [inventory];
GO

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--
CREATE TABLE [dbo].[notes] (
  [id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [contents] NVARCHAR(MAX) NOT NULL,
  [admin] NVARCHAR(20) NOT NULL,
  [status] NVARCHAR(8) NOT NULL DEFAULT 'aktif'
);

--
-- Dumping data for table `notes`
--
SET IDENTITY_INSERT [dbo].[notes] ON;
INSERT INTO [dbo].[notes] ([id], [contents], [admin], [status]) VALUES
(21, 'Disini bisa tulis notes', 'Stock', 'aktif');
SET IDENTITY_INSERT [dbo].[notes] OFF;

-- --------------------------------------------------------

--
-- Table structure for table `sbrg_keluar`
--
CREATE TABLE [dbo].[sbrg_keluar] (
  [id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [idx] INT NOT NULL,
  [tgl] DATE NOT NULL,
  [jumlah] INT NOT NULL,
  [penerima] NVARCHAR(35) NOT NULL,
  [keterangan] NVARCHAR(MAX) NOT NULL
);

--
-- Dumping data for table `sbrg_keluar`
--
SET IDENTITY_INSERT [dbo].[sbrg_keluar] ON;
INSERT INTO [dbo].[sbrg_keluar] ([id], [idx], [tgl], [jumlah], [penerima], [keterangan]) VALUES
(15, 244, '2020-08-29', 1000, 'Kasmina', 'Laku');
SET IDENTITY_INSERT [dbo].[sbrg_keluar] OFF;

-- --------------------------------------------------------

--
-- Table structure for table `sbrg_masuk`
--
CREATE TABLE [dbo].[sbrg_masuk] (
  [id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [idx] INT NOT NULL,
  [tgl] DATE NOT NULL,
  [jumlah] INT NOT NULL,
  [keterangan] NVARCHAR(MAX) NOT NULL
);

--
-- Dumping data for table `sbrg_masuk`
--
SET IDENTITY_INSERT [dbo].[sbrg_masuk] ON;
INSERT INTO [dbo].[sbrg_masuk] ([id], [idx], [tgl], [jumlah], [keterangan]) VALUES
(9, 244, '2020-08-07', 600, 'kk');
SET IDENTITY_INSERT [dbo].[sbrg_masuk] OFF;

-- --------------------------------------------------------

--
-- Table structure for table `slogin`
--
CREATE TABLE [dbo].[slogin] (
  [id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [username] NVARCHAR(30) NOT NULL,
  [password] NVARCHAR(255) NOT NULL,
  [nickname] NVARCHAR(20) NOT NULL,
  [role] NVARCHAR(10) NOT NULL
);

--
-- Dumping data for table `slogin`
--
SET IDENTITY_INSERT [dbo].[slogin] ON;
INSERT INTO [dbo].[slogin] ([id], [username], [password], [nickname], [role]) VALUES
(7, 'guest', '084e0343a0486ff05530df6c705c8bb4', 'Stock', 'stock');
SET IDENTITY_INSERT [dbo].[slogin] OFF;

-- --------------------------------------------------------

--
-- Table structure for table `sstock_brg`
--
CREATE TABLE [dbo].[sstock_brg] (
  [idx] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,
  [nama] NVARCHAR(55) NOT NULL,
  [jenis] NVARCHAR(30) NOT NULL,
  [merk] NVARCHAR(40) NOT NULL,
  [ukuran] NVARCHAR(20) NOT NULL,
  [stock] INT NOT NULL,
  [satuan] NVARCHAR(10) NOT NULL,
  [lokasi] NVARCHAR(55) NOT NULL
);

--
-- Dumping data for table `sstock_brg`
--
SET IDENTITY_INSERT [dbo].[sstock_brg] ON;
INSERT INTO [dbo].[sstock_brg] ([idx], [nama], [jenis], [merk], [ukuran], [stock], [satuan], [lokasi]) VALUES
(243, 'Mata Bor', 'Flame', 'Garryson', '50', 2992, 'Buah', 'PT Willtec'),
(244, 'Mata Bor', 'Ball Nosed Cone', 'Garryson', '17', 1000, 'Unit', 'PT Wiltec');
SET IDENTITY_INSERT [dbo].[sstock_brg] OFF;

-- Enable foreign key checks again
EXEC sp_MSforeachtable 'ALTER TABLE ? WITH CHECK CHECK CONSTRAINT ALL';
