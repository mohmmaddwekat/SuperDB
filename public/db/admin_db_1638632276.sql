

CREATE TABLE `empoyee` (
  `EmpoyeeID` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO empoyee VALUES("2","Cardinal","Tom B. Erichsen"," Skagen 21 Stavanger 4006","Norway");
INSERT INTO empoyee VALUES("3","Cardinalsad","Tom B. Erichsen"," Skagen 21 Stavanger 4006","Norway");
INSERT INTO empoyee VALUES("4","Cardinal","Tdgdgh"," Skagen 21 Stavanger 4006","Norway");
INSERT INTO empoyee VALUES("5","stet43reg","Tom B. Erichsen"," Skagen 21 Stavanger 4006","Norway");
INSERT INTO empoyee VALUES("6","vfdgfdg","Tom B. Erichsen"," Skagen 21 Stavanger 4006","Norway");
INSERT INTO empoyee VALUES("7","regrehfdbhfdnb","Tom B. Erichsen"," Skagen 21 Stavanger 4006","Norway");





CREATE TABLE `person` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO person VALUES("1","Heber","Camrynborough","26728","Home Health Aide");
INSERT INTO person VALUES("2","Modesto","West Janet","15152-2683","Software Engineer");
INSERT INTO person VALUES("3","Dante","East Chanel","74689-6886","Entertainment Attendant");
INSERT INTO person VALUES("4","Nolan","Murphyville","32561-8079","Credit Authorizer");
INSERT INTO person VALUES("6","Jaeden","Greenfort","06179-1759","School Social Worker");
INSERT INTO person VALUES("7","Efrain","West Blairborough","11282-0496","Electronic Drafter");
INSERT INTO person VALUES("8","Travon","South Tatum","76603-0822","Manufactured Building Installer");
INSERT INTO person VALUES("9","Agustina","North Gertrudeland","18950","Health Services Manager");





CREATE TABLE `user` (
  `PersonID` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO user VALUES("23","Cardinal","XSAFDDFGREGREG","DFE","TRHT");
INSERT INTO user VALUES("32","dswq","ADWFE","SD","HYJ");
INSERT INTO user VALUES("22","Cardinal","dssaad","SAD","GH");
INSERT INTO user VALUES("12","wqe","Tom B. Erichsen","SFE","Norway");
INSERT INTO user VALUES("21","rrrr","trghtrh","F","SVGRE");
INSERT INTO user VALUES("52","sr","sdewqd","D","Norway");



