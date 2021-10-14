-- a. Atores do filme com título “XYZ"
SELECT a.*
FROM filme f
         INNER JOIN participa p ON (f.id = p.idFilme)
         INNER JOIN ator a ON (p.idAtor = a.id)
WHERE f.titulo like "%XYZ%";


-- b. Filmes que o ator de nome “FULANO” participou.
SELECT f.*
FROM filme f
         INNER JOIN participa p ON (f.id = p.idFilme)
         INNER JOIN ator a ON (p.idAtor = a.id)
WHERE a.nome like "%FULANO%";


-- c. Listar os filmes do ano 2015 ordenados pela quantidade de atores participantes e pelo título em ordem alfabética
SELECT f.*,
       (SELECT count(idAtor)
        FROM participa
        WHERE idfilme = f.id) AS Atores
FROM filme f
WHERE f.ano = 2015
ORDER BY Atores DESC,
         f.titulo ASC;


-- d. Listar os atores que trabalharam em filmes cujo diretor foi “SPIELBERG”.
SELECT a.*
FROM filme f
         INNER JOIN participa p ON (f.id = p.idFilme)
         INNER JOIN ator a ON (p.idAtor = a.id)
         INNER JOIN dirige d ON (f.id = d.idFilme)
         INNER JOIN diretor dr ON (d.idDiretor = dr.id)
WHERE dr.nome like "%SPIELBERG%";