DROP TABLE IF EXISTS learnpaths;
create table learnpaths (
       `LearnPath_Id` INT(11) UNSIGNED AUTO_INCREMENT,
       `Common_Name` VARCHAR(255) NOT NULL,
       `Description` TEXT DEFAULT '',
       `Created` TimeStamp DEFAULT CURRENT_TIMESTAMP,
       `Creator` INT(11)  UNSIGNED,
       Primary Key(`LearnPath_Id`),
       UNIQUE (Common_Name),
       FOREIGN KEY (`Creator`)  REFERENCES `users` (`User_Id`)
       	       ON DELETE SET NULL
	       ON UPDATE CASCADE
);

DROP TABLE IF EXISTS learnpaths_article;
CREATE TABLE learnpaths_article (
       `LearnPath_Id` INT(11) UNSIGNED,
       `Article_Id`   INT(11) UNSIGNED,
       Primary Key(LearnPath_Id, Article_Id),
       FOREIGN KEY (LearnPath_Id) REFERENCES learnpaths (LearnPath_Id)
       	       ON DELETE SET NULL
               ON UPDATE CASCADE , 
       FOREIGN KEY (Article_Id) REFERENCES articles (Article_Id)
       	       ON DELETE SET NULL
	       ON UPDATE CASCADE	
);