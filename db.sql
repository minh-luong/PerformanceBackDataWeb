create table accounts (
    uid varchar(40) primary key,
    username varchar(100) not null,
    password varchar(200) not null,
    fullname varchar(100) not null
);