CREATE TABLE `Include` (
  `IncludeID` int NOT NULL,
  `BookID` int NOT NULL,
  `ChapterID` int NOT NULL,
  PRIMARY KEY  (`includeID`)
);


CREATE TABLE `Wrote` (
  `WroteID` int NOT NULL,
  `AuthorID` int NOT NULL,
  `BookID` int NOT NULL,
  PRIMARY KEY  (`WroteID`)
);


CREATE TABLE `Belong` (
  `BelongID` int NOT NULL,
  `SeriesID` int NOT NULL,
  `BookID` int NOT NULL,
  PRIMARY KEY  (`BelongID`)
);