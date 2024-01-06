create table uzivatel(
id int primary key identity(1,1) NOT NULL,
email varchar(255) UNIQUE CHECK(email like '%@%.%'),
password varchar(255) NOT NULL CHECK(len(password) >= 8)
);