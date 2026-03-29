create table users (
    uid varchar(40) primary key,
    username varchar(100) not null,
    password varchar(200) not null,
    fullname varchar(100) not null,
    role varchar(20) default 'user',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table data (

)