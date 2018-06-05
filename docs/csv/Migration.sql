select 'NivelesAcademicos';
load data local infile 'NivelesAcademicos.csv'
into table niveles_academicos
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, nivel_academico);

select 'TiposPlanesEspecialidades';
load data local infile 'TiposPlanesEspecialidades.csv'
into table tipos_planes_especialidades
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, tipo_plan_especialidad);

select 'ModalidadesEspecialidades';
load data local infile 'ModalidadesEspecialidades.csv'
into table modalidades_especialidades
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, modalidad_especialidad);

select 'Especialidades';
load data local infile 'Especialidades.csv'
into table especialidades
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, nivel_academico_id, clave, especialidad, reconocimiento_oficial, dges, fecha_reconocimiento, modalidad_id, tipo_plan_especialidad_id);

select 'Periodos';
load data local infile 'Periodos.csv'
into table periodos
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, anio, periodo, fecha_reconocimiento, jefe_control, director);

select 'TiposExamenes';
load data local infile 'TiposExamenes.csv'
into table tipos_examenes
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, tipo_examen);

select 'FechasExamenes';
load data local infile 'FechasExamenes.csv'
into table fechas_examenes
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, tipo_examen_id, fecha, periodo_id);

select 'Asignaturas';
load data local infile 'Asignaturas.csv'
into table asignaturas
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, codigo, asignatura, creditos);

select 'Titulos';
load data local infile 'Titulos.csv'
into table titulos
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, titulo);

select 'RolesUsuarios';
load data local infile 'RolesUsuarios.csv'
into table roles_usuarios
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, rol_usuario);

select 'Usuarios [Admin, Docente]';
insert into usuarios values (1, 'admin@appsamx.com','$2a$04$bbSLcJgSpyG.HIBFh9PS3O0cK52LzY2GtTUTYA8K3gSpCGMcdnmHa',1);
insert into usuarios values (2, 'docente@appsamx.com', '$2a$04$bbSLcJgSpyG.HIBFh9PS3O0cK52LzY2GtTUTYA8K3gSpCGMcdnmHa', 2);

select 'UsuariosDocentes';
load data local infile 'UsuariosDocentes.csv'
into table usuarios
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(`id`, `email`, `password`, `rol_id`);

select 'EstadosCiviles';
load data local infile 'EstadosCiviles.csv'
into table estados_civiles
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, estado_civil);


source ../paises.sql;
source ../estados.sql;
source ../municipios.sql;
source ../localidades.sql;


select 'Nacionalidades';
load data local infile 'Nacionalidades.csv'
into table nacionalidades
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, nacionalidad);

select 'DatosGenerales [Docente]';
insert into datos_generales (id, nombre, apaterno, amaterno, localidad_id, estado_civil_id, nacionalidad_id) values (1, 'N/A', 'N/A', 'N/A', 94493, 1, 104);

select 'DatosDocentes';
load data local infile 'DatosDocentes.csv'
into table datos_generales
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, curp, nombre, apaterno, amaterno, fecha_nacimiento, calle_numero, colonia, codigo_postal , localidad_id, telefono_personal, telefono_casa, estado_civil_id, sexo, fecha_registro, nacionalidad_id);

select '[Docente]';
insert into docentes (id, codigo, dato_general_id, titulo_id, usuario_id) values (1, 'N/A', 1, 1, 2);

select 'Docentes';
load data local infile 'Docentes.csv'
into table docentes
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n';

select 'PlanesEspecialides';
load data local infile 'PlanesEspecialidades.csv'
into table planes_especialidades
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, plan_especialidad, semestres, especialidad_id, coordinador_id);

select 'Reticulas';
load data local infile 'Reticulas.csv'
into table reticulas
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n';

select 'EstadosEstudiantes';
load data local infile 'EstadosEstudiantes.csv'
into table estados_estudiantes
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, estado_estudiante);

select 'DatosEstudiantes';
load data local infile 'DatosEstudiantes.csv'
into table datos_generales
fields terminated by ',' enclosed by '"' 
lines terminated by '\n'
(id, curp, nombre, apaterno, amaterno, fecha_nacimiento, calle_numero, colonia, localidad_id, telefono_personal, telefono_casa, estado_civil_id, sexo, fecha_registro, email, codigo_postal, nacionalidad_id);

select 'ModalidadesEstudiantes';
load data local infile 'ModalidadesEstudiantes.csv'
into table modalidades_estudiantes
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, modalidad_estudiante);

select 'MediosEnterados';
load data local infile 'MediosEnterados.csv'
into table medios_enterados
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, medio_enterado);

select 'UsuariosEstudiantes';
load data local infile 'UsuariosEstudiantes.csv'
into table usuarios
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(`id`, `email`, `password`, `rol_id`);

select 'Estudiantes';
load data local infile 'Estudiantes.csv'
into table estudiantes
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, dato_general_id, especialidad_id, estado_estudiante_id, matricula, semestre, semestre_disp, grupo, modalidad_id, medio_enterado_id, periodo_id, usuario_id, plan_especialidad_id);

select 'Clases';
load data local infile 'Clases.csv'
into table clases
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n';

select 'Oportunidades';
load data local infile 'Oportunidades.csv'
into table oportunidades
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, oportunidad);

select 'Grupos';
load data local infile 'Grupos.csv'
into table grupos
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n';

select 'Kardexs';
load data local infile 'Kardexs.csv'
into table kardexs
fields terminated by ',' enclosed by '"'
lines terminated by '\r\n'
(id, estudiante_id, asignatura_id, oportunidad_id, periodo_id, calificacion);