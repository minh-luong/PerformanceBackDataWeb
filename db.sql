create table users (
    uid varchar(40) primary key,
    username varchar(100) not null,
    password varchar(200) not null,
    fullname varchar(100) not null,
    role varchar(20) default 'user',
    status varchar(20) default 'active',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table categories (
    category_id int auto_increment primary key,
    name varchar(100) not null,
    description text,
    rate integer not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table monthly_reports (
    report_id integer auto_increment primary key,
    uid varchar(40) not null,
    year integer not null,
    month integer not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (uid) references users(uid)
);

create table report_details (
    report_id integer not null,
    category_id integer not null,
    score integer not null,
    content text,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key (report_id, category_id),
    foreign key (report_id) references monthly_reports(report_id),
    foreign key (category_id) references categories(category_id)
);