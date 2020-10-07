drop database if exists `app-log-database`;
create database if not exists `app-log-database`;
use `app-log-database`;
create table if not exists roles(
    role_id int not null auto_increment,
    role_name varchar(150) not null,
    primary key(role_id)
);
create table if not exists status(
    status_id int not null auto_increment,
    status_name varchar(150) not null,
    primary key(status_id)
);
create table if not exists users(
    user_id int not null auto_increment,
    user_email varchar(150) not null,
    user_password varchar(150) not null,
    role_id int not null,
    primary key(user_id),
    foreign key (role_id) references roles(role_id)
);
create table if not exists backlogs(
    backlog_id int not null auto_increment,
    backlog_name varchar(150) not null,
    user_id int not null,
    primary key(backlog_id),
    foreign key (user_id) references users(user_id)
);
create table if not exists backlog_items(
    backlog_item_id int not null auto_increment,
    backlog_item_name varchar(150) not null,
    backlog_item_description varchar(150) not null,
    backlog_item_effort int not null,
    backlog_id int not null,
    primary key(backlog_item_id),
    foreign key (backlog_id) references backlogs(backlog_id)
);
create table if not exists sprints(
    sprint_id int not null auto_increment,
    sprint_goal varchar(150) not null,
    sprint_time int not null default 4,
    sprint_start_date date not null default now(),
    sprint_end_date date not null default date_add(now(), interval 4 week),
    backlog_id int not null,
    primary key(sprint_id),
    foreign key (backlog_id) references backlogs(backlog_id)
);
create table if not exists sprint_items(
    sprint_item_id int not null auto_increment,
    backlog_item_id int not null,
    status_id int not null,
    sprint_id int not null,
    primary key(sprint_item_id),
    foreign key (backlog_item_id) references backlog_items(backlog_item_id),
    foreign key (status_id) references status(status_id),
    foreign key (sprint_id) references sprints(sprint_id)
);
insert into roles (role_name) values ("product-owner");
insert into status (status_name) values ("created"), ("started"), ("stand-by"), ("in-progress"), ("finished");
insert into users (user_email, user_password, role_id) values ("owner@applog.com", "123", 1);
insert into backlogs (backlog_name, user_id) values ("applog", 1);
insert into backlog_items (backlog_item_name, backlog_item_description, backlog_item_effort, backlog_id) values ("Item 1", "Description of Item 1", 12, 1);
insert into sprints (sprint_goal, backlog_id) values ("To make a backlog web app", 1);