load data local infile 'NivelesAcademicos.csv'
into table niveles_academicos
fields terminated by ','
lines terminated by '\n'
(id, nivel_academico);

load data local infile 'TiposPlanesEspecialidades.csv'
into table tipos_planes_especialidades
fields terminated by ','
lines terminated by '\n'
(id, tipo_plan_especialidad);

load data local infile 'ModalidadesEspecialidades.csv'
into table modalidades_especialidades
fields terminated by ','
lines terminated by '\n'
(id, modalidad_especialidad);

load data local infile 'Especialidades.csv'
into table especialidades
fields terminated by ','
lines terminated by '\n'
(id, nivel_academico_id, clave, especialidad, reconocimiento_oficial, dges, fecha_reconocimiento, modalidad_id, tipo_plan_especialidad_id);

load data local infile 'Periodos.csv'
into table periodos
fields terminated by ','
lines terminated by '\n'
(id, anio, periodo, fecha_reconocimiento, jefe_control, director);

load data local infile 'TiposExamenes.csv'
into table tipos_examenes
fields terminated by ','
lines terminated by '\n'
(id, tipo_examen);

load data local infile 'FechasExamenes.csv'
into table fechas_amenes
fields terminated by ','
lines terminated by '\n'
(id, tipo_examen_id, fecha, periodo_id);

load data local infile 'Asignaturas.csv'
into table asignaturas
fields terminated by ','
lines terminated by '\n'
(id, codigo, asignatura, creditos);

load data local infile 'Titulos.csv'
into table titulos
fields terminated by ','
lines terminated by '\n'
(id, titulo);

load data local infile 'RolesUsuarios.csv'
into table roles_usuarios
fields terminated by ','
lines terminated by '\n'
(id, rol_usuario);

insert into usuarios values (1, 'admin@appsamx.com','$2a$04$bbSLcJgSpyG.HIBFh9PS3O0cK52LzY2GtTUTYA8K3gSpCGMcdnmHa',1);

load data local infile 'UsuariosDocentes.csv'
into table usuarios
fields terminated by ','
lines terminated by '\n'
(`id`, `email`, `password`, `rol_id`);