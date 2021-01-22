insert into
  event(id, type)
values('1', 'mariage');
insert into
  event(id, type)
values('2', 'congrès');
insert into
  event(id, type)
values('3', 'anniversaire');
insert into
  event(id, type)
values('4', 'circoncision');
insert into
  event_service(event_id, service_id)
values('1', '1');
insert into
  event_service(event_id, service_id)
values('1', '2');
insert into
  event_service(event_id, service_id)
values('1', '4');
insert into
  event_service(event_id, service_id)
values('1', '5');
insert into
  event_service(event_id, service_id)
values('2', '1');
insert into
  event_service(event_id, service_id)
values('2', '3');
insert into
  event_service(event_id, service_id)
values('3', '1');
insert into
  event_service(event_id, service_id)
values('3', '2');
insert into
  event_service(event_id, service_id)
values('3', '3');
insert into
  event_service(event_id, service_id)
values('3', '4');
insert into
  event_service(event_id, service_id)
values('3', '5');
insert into
  event_service(event_id, service_id)
values('4', '3');
insert into
  event_service(event_id, service_id)
values('4', '5');
insert into
  event_service(event_id, service_id)
values('4', '6');
insert into
  option(id, name, description)
values(
    '1',
    `Sans décoration`,
    `juste les tables et les chaises`
  );
insert into
  option(id, name, description)
values(
    '2',
    `belle décoration`,
    `les tables et les chaises sont accommodées avec une belle décoration digne d'un mariage`
  );
insert into
  option(id, name, description)
values(
    '3',
    `Décorations Royales`,
    `Les décorations des tables et des chaises ainsi que des trônes pour les personnes à l'honneur`
  );
insert into
  option(id, name, description)
values(
    '4',
    `Couvert de restauration`,
    `des assiettes courantes, des couverts normaux de base`
  );
insert into
  option(id, name, description)
values(
    '5',
    `Couvert de fêtes`,
    `Couverts de luxes, verres suivants accompagnements, assiettes décorées`
  );
insert into
  service_option(service_id, option_id)
values('1', '1');
insert into
  service_option(service_id, option_id)
values('1', '2');
insert into
  service_option(service_id, option_id)
values('1', '3');
insert into
  service_option(service_id, option_id)
values('1', '5');
insert into
  service(id, title, description)
values('1', 'tables', 'décoration des tables');
insert into
  service(id, title, description)
values(
    '2',
    'vaisselle',
    'mise à disposition de la vaisselle'
  );
insert into
  service(id, title, description)
values('3', 'banquet', 'organisation de banquet');
insert into
  service(id, title, description)
values(
    '4',
    'cuisine',
    'préparation des repas et mise à disposition pour les serveurs'
  );
insert into
  service(id, title, description)
values(
    '5',
    'serveurs',
    'équipe faisant le service à table'
  );
insert into
  service(id, title, description)
values(
    '6',
    'animation particulière',
    'magicien, clown, baby-sitting'
  );