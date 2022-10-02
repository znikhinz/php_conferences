DROP TABLE IF EXISTS `conferences`;
create table `conferences`(
  `id` VARCHAR(36) default uuid(),
  `title` VARCHAR(255) not null,
  `date` DATETIME not null,
  `lat` float,
  `lng` float,
  `country` varchar(255) not null,
  primary key (`id`)
);

insert into `conferences` (title, date, country)
values('Test conf', '2020-01-01 10:10:10', 'Ukraine');