CREATE TABLE `Books` (
  `BookID` int NOT NULL,
  `Bookname` varchar(50),
  `ISBN` text,
  `Pubdate` text,
  `Price` text,
  `Introduction` text,
  `Picture` text,
  PRIMARY KEY  (`BookID`)
);

CREATE TABLE `AuthorS` (
  `AuthorID` int NOT NULL,
  `Authorname` varchar(50),
  `Field` varchar(50),
  `Organization` varchar(20),
  PRIMARY KEY  (`AuthorID`)
);


CREATE TABLE `Chapters` (
  `ChapterID` int NOT NULL,
  `Chaptername` varchar(50),
  `Chapterauthor` varchar(20),
  PRIMARY KEY  (`ChapterID`)
);

CREATE TABLE `Series` (
  `SeriesID` int NOT NULL,
  `Seriesname` varchar(50),
  PRIMARY KEY  (`SeriesID`)
);





