bercousuarioselect * from armazenamentodados;

select * from gerarelatorio;

select * from cidade
;

delete from where data_hora_evento = "2019-10-09 17:12:16";
	
select * from cadastrousuario;
select * from cadastrosensores
;

select * from bercosensor;

insert into cidade (nome) values ('Palotina');

select * from cidade;

insert into armazenamentodados (id_berco, id_sensor, data_hora_evento, tipo_evento, observacao_evento) values ("1", "5", now(), "", "");

delete from armazenamentodados where id_sensor = 2;

ALTER DATABASE babycontrol CHARSET = UTF8 COLLATE = utf8_general_ci;

CREATE TABLE `cidade` (
  `id` int(11) DEFAULT NULL,
  `nome`  varchar(45) DEFAULT NULL,
 





delimiter $
 
create trigger tg_historico after update
on armazenamentodados
for each row
begin
    insert into gerarelatorio (id_berco, id_sensor, data_hora_evento, tipo_evento, observacao_evento) values (new.id_berco, new.id_sensor, new.data_hora_evento, new.tipo_evento, new.observacao_evento);
end $

select * from gerarelatorio;