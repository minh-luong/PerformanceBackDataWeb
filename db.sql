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

create table groups (
    group_id varchar(25) primary key,
    name varchar(255) not null,
    description text,
    year integer not null default year(current_date),
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table categories (
    category_id varchar(25) primary key,
    name varchar(100) not null,
    description text,
    rate integer not null,
    group_id varchar(25) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (group_id) references groups(group_id) on delete cascade
);

create table monthly_reports (
    report_id varchar(25) primary key,
    uid varchar(40) not null,
    month integer not null,
    group_id varchar(25) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (uid) references users(uid) on delete cascade,
    foreign key (group_id) references groups(group_id) on delete cascade
);

create table report_details (
    report_id varchar(25) not null,
    category_id varchar(25) not null,
    score integer not null,
    content text,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    primary key (report_id, category_id),
    foreign key (report_id) references monthly_reports(report_id) on delete cascade,
    foreign key (category_id) references categories(category_id) on delete cascade
);

create table group_members (
    group_id varchar(25) not null,
    uid varchar(40) not null,
    role varchar(20) default 'member',
    primary key (group_id, uid),
    foreign key (group_id) references groups(group_id) on delete cascade,
    foreign key (uid) references users(uid) on delete cascade,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);