drop view if exists vw_estudiantes;
create view vw_estudiantes
as
	select 
		estudiantes.id as estudiante_id, 
        matricula, 
        concat(apaterno,' ',amaterno,'',nombre) as nombre,
        grupo,
        concat(calle_numero,', ',colonia,', ',codigo_postal,', ',municipio) as  direccion,
        telefono_personal,
        email,
        fecha_nacimiento,
        modalidad_estudiante,
        medio_enterado,
        empresa_id,
        empresa,
        puesto
    from estudiantes
		left join datos_generales on datos_generales.id = estudiantes.dato_general_id
        left join localidades on localidades.id = datos_generales.localidad_id
        left join municipios on municipios.id = localidades.municipio_id
        left join modalidades_estudiantes on modalidades_estudiantes.id = estudiantes.modalidad_id
        left join medios_enterados on medios_enterados.id = estudiantes.medio_enterado_id
        left join estudiantes_trabajos on estudiantes_trabajos.estudiante_id = estudiantes.id
        left join empresas on empresas.id = estudiantes_trabajos.empresa_id;
        
drop view if exists vw_fechas_examenes;
create view vw_fechas_examenes
as
	select
		fechas_examenes.id  as id,
        tipo_examen_id,
        tipo_examen,
        fecha_inicio,
        fecha_final,
        fechas_examenes.descripcion as descripcion,
        periodo_id
	from fechas_examenes
		join tipos_examenes on tipos_examenes.id = fechas_examenes.tipo_examen_id;

select * from vw_fechas_examenes;

drop view if exists vw_especialidades;
create view vw_especialidades
as
	select
		especialidades.id as id,
		nivel_academico_id,
		clave,
        especialidad,
        reconocimiento_oficial,
        fecha_reconocimiento,
        dges,
        especialidades.descripcion as descripcion,
        modalidad_id,
        modalidad_especialidad,
        tipo_plan_especialidad_id,
        tipo_plan_especialidad
    from especialidades
		join niveles_academicos on niveles_academicos.id = especialidades.nivel_academico_id
        join modalidades_especialidades on modalidades_especialidades.id = especialidades.modalidad_id
        join tipos_planes_especialidades on tipos_planes_especialidades.id = especialidades.tipo_plan_especialidad_id;

select * from vw_especialidades;

drop view if exists vw_docentes;
create view vw_docentes 
as
	select 
		docentes.id as docente_id,
        codigo,
        nombre,
        apaterno,
        amaterno,
        fecha_nacimiento,
        telefono_casa,
        rfc,
        titulo
    from docentes
		join datos_generales on datos_generales.id = docentes.dato_general_id
        join titulos on titulos.id = docentes.titulo_id;
select * from vw_docentes;