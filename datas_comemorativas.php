<?php
// -----------------------------------------------------
// Datas Comemorativas 2008
// -----------------------------------------------------
// Desenvolvido por Vitor Martins Santos
// rotiv.nit@gmail.com
// -----------------------------------------------------
// Para usar, coloque:
// include("datas_comemorativas.php");
// no c�digo de sua p�gina onde ir� aparecer o dia!
// -----------------------------------------------------


// Escolha como quer separar quando tiver mais de uma 
// comemora��o no mesmo dia.
// Por exemplo, se quiser que apare�a um em cada linha,
// coloque: <br />
$separador = "|";



$dia = date("d");
$mes = date("m");

if ($mes == 01) {
	switch($dia) {
		case 01: echo "Confraterniza��o Universal $separador Dia Mundial da Paz"; break;
		case 02: echo "Dia da Abreugrafia"; break;
		case 05: echo "Cria��o da 1� Tipografia no Brasil"; break;
		case 06: echo "Dia de Reis $separador Dia da Gratid�o"; break;
		case 07: echo "Dia da Liberdade de Cultos"; break;
		case 08: echo "Dia do Fot�grafo"; break;
		case 09: echo "Dia do Fico (1822)"; break;
		case 14: echo "Dia do Enfermo"; break;
		case 20: echo "Dia do Museu de Arte Moderna do RJ"; break;
		case 20: echo "Dia do Farmac�utico"; break;
		case 21: echo "Dia Mundial da Religi�o"; break;
		case 24: echo "Dia da Previd�ncia Social $separador Dia da Constitui��o $separador Institui��o do Casamento civil no Brasil"; break;
		case 25: echo "Dia do Carteiro $separador Funda��o de S�o Paulo $separador Cria��o dos Correios e Tel�grafos no Brasil"; break;
		case 27: echo "Dia da Eleva��o do Brasil Vice-Reinado (1763)"; break;
		case 28: echo "Dia da Abertura dos Portos (1808)"; break;
		case 30: echo "Dia da Saudade $separador Dia do Portu�rio $separador Dia Nacional das Hist�rias em Quadrinhos $separador Dia da N�o-Viol�ncia"; break;
		case 31: echo "Dia do lan�amento do 1� Sat�lite � EUA (1958)"; break;
	}
}
else if ($mes == 02) {
	switch($dia) {
		case 02: echo "Dia do Agente Fiscal $separador Dia de Iemanj�"; break;
		case 05: echo "Dia do Datiloscopista"; break;
		case 07: echo "Dia do Gr�fico"; break;
		case 09: echo "Dia do Zelador"; break;
		case 11: echo "Dia da Cria��o da Casa de Moeda $separador Dia Mundial do Enfermo"; break;
		case 13: echo "Dia Nacional do Minist�rio P�blico"; break;
		case 14: echo "Dia da Amizade"; break;
		case 16: echo "Dia do Rep�rter"; break;
		case 19: echo "Dia do Esportista"; break;
		case 21: echo "Dia da Conquista do Monte Castelo (1945) $separador Data Festiva do Ex�rcito"; break;
		case 23: echo "Dia do Rotaryano"; break;
		case 24: echo "Promulga��o da 1� Constitui��o Republicana (1891)"; break;
		case 25: echo "Dia da cria��o do Minist�rio das Comunica��es"; break;
		case 27: echo "Dia dos Idosos $separador Dia do Agente Fiscal da Receita Federal"; break;
		case 28: echo "Carnaval"; break;
	}
}
elseif ($mes == 03) {
	switch($dia) {
		case 02: echo "Dia Nacional do Turismo"; break;
		case 03: echo "Dia do Meteorologista"; break;
		case 05: echo "Dia do Filatelista Brasileiro $separador Dia Mundial da Ora��o (1� Sexta-feira do m�s)"; break;
		case 07: echo "Dia do Fuzileiros Navais"; break;
		case 08: echo "Dia Internacional da Mulher"; break;
		case 10: echo "Dia do Telefone"; break;
		case 12: echo "Dia do Bibliotec�rio"; break;
		case 14: echo "Dia do Vendedor de Livros $separador Dia Nacional da Poesia $separador Dia dos Animais"; break;
		case 15: echo "Dia da Escola $separador Dia Mundial do Consumidor"; break;
		case 19: echo "Dia de S�o Jos� $separador Dia do Carpinteiro $separador Dia do Marceneiro"; break;
		case 20: echo "In�cio do outono"; break;
		case 21: echo "Dia Universal do Teatro $separador Dia Internacional Contra a Discrimina��o Racial"; break;
		case 23: echo "Dia Mundial da Meteorologia"; break;
		case 26: echo "Dia do Cacau"; break;
		case 27: echo "Dia do Circo"; break;
		case 28: echo "Dia do Diagramador $separador Revisor"; break;
		case 31: echo "Dia da Integra��o Nacional $separador Dia da Sa�de e Nutri��o"; break;
	}
}
elseif ($mes == 04) {
	switch($dia) {
		case 01: echo "Dia da Mentira"; break;
		case 02: echo "Dia do Propagandista"; break;
		case 04: echo "Dia Nacional do Parkinsoniano"; break;
		case 06: echo "Sexta-feira Santa"; break;
		case 07: echo "Dia do Corretor $separador Dia do Jornalismo $separador Dia do M�dico Legista $separador Dia Mundial da Sa�de"; break;
		case 08: echo "Dia da Nata��o $separador Dia do Correio $separador Dia Mundial do Combate ao C�ncer $separador P�scoa"; break;
		case 09: echo "Dia Nacional do A�o"; break;
		case 10: echo "Dia da Engenharia"; break;
		case 12: echo "Dia do Obstetra"; break;
		case 13: echo "Dia do Office-Boy"; break;
		case 13: echo "Dia dos Jovens"; break;
		case 14: echo "Dia Pan-Americano"; break;
		case 15: echo "Dia da Conserva��o do Solo $separador Dia Mundial do Desenhista $separador Dia do Desarmamento Infantil"; break;
		case 18: echo "Dia Nacional do Livro Infantil $separador Dia de Monteiro Lobato"; break;
		case 19: echo "Dia do Ex�rcito Brasileiro $separador Dia do �ndio"; break;
		case 20: echo "Dia do Diplomata"; break;
		case 21: echo "Tiradentes $separador Dia da Latinidade $separador Dia da Pol�cia Civil $separador Dia do Metal�rgico"; break;
		case 22: echo "Descobrimento do Brasil $separador Dia da For�a A�rea Brasileira $separador Dia da Comunidade luso-brasileira"; break;
		case 23: echo "Dia de S�o Jorge $separador Dia Mundial do Escoteiro"; break;
		case 24: echo "Dia do Agente de Viagem $separador Dia Internacional do Jovem Trabalhador"; break;
		case 25: echo "Dia do Contabilista $separador Dia da ONU"; break;
		case 26: echo "Dia do Goleiro $separador Dia da 1� Missa no Brasil"; break;
		case 27: echo "Dia da Empregada Dom�stica $separador Dia do Sacerdote"; break;
		case 28: echo "Dia da Educa��o $separador Dia da Sogra"; break;
		case 30: echo "Dia do Ferrovi�rio $separador Dia Nacional da Mulher"; break;
	}
}
elseif ($mes == 05) {
	switch($dia) {
		case 01: echo "Dia Mundial do Trabalho"; break;
		case 02: echo "Dia Nacional do Ex-combatente $separador Dia do Taqu�grafo"; break;
		case 03: echo "Dia do Sertanejo"; break;
		case 05: echo "Dia de Rondon $separador Dia da Comunidade $separador Dia Nacional do Expedicion�rio $separador Dia do Pintor"; break;
		case 06: echo "Dia do Cart�grafo"; break;
		case 07: echo "Dia do Oftalmologista $separador Dia do Sil�ncio"; break;
		case 08: echo "Dia da Vit�ria $separador Dia do Profissional Marketing $separador Dia do Artista Pl�stico $separador Internacional da Cruz Vermelha"; break;
		case 09: echo "Dia da Europa"; break;
		case 10: echo "Dia da Cavalaria $separador Dia do Campo"; break;
		case 11: echo "Integra��o do Tel�grafo no Brasil"; break;
		case 12: echo "Dia Mundial do Enfermeiro"; break;
		case 13: echo "Dia da Ascen��o $separador Aboli��o da Escravatura $separador Dia da Fraternidade Brasileira $separador Dia do Autom�vel"; break;
		case 14: echo "Dia das M�es $separador Dia Continental do Seguro"; break;
		case 15: echo "Dia do Assistente Social $separador Dia do Gerente Banc�rio"; break;
		case 16: echo "Dia do Gari"; break;
		case 17: echo "Dia Internacional da Comunica��o e das Telecomunica��es $separador Dia da Constitui��o"; break;
		case 18: echo "Dia dos Vidreiros $separador Dia Internacional dos Museus"; break;
		case 19: echo "Dia dos Acad�micos do Direito"; break;
		case 20: echo "Dia do Comiss�rio de Menores"; break;
		case 21: echo "Dia da L�ngua Nacional"; break;
		case 22: echo "Dia do Apicultor"; break;
		case 23: echo "Dia da Juventude Constitucionalista"; break;
		case 24: echo "Dia da Infantaria $separador Dia do Caf� $separador Dia do Datil�grafo $separador Dia do Detento $separador Dia do Telegrafista $separador Dia do Vestibulando"; break;
		case 25: echo "Dia da Ind�stria $separador Dia do Massagista $separador Dia do Trabalhador Rural"; break;
		case 27: echo "Ascen��o $separador Dia do Profissional Liberal"; break;
		case 29: echo "Dia do Estat�stico $separador Dia do Ge�grafo"; break;
		case 30: echo "Dia da Decora��o $separador Dia do Ge�logo $separador Dia das Bandeiras"; break;
		case 31: echo "Dia do Comiss�rio de Bordo $separador Dia Mundial das Comunica��es Sociais $separador Dia do Esp�rito Santo"; break;
	}
}
elseif ($mes == 06) {
	switch($dia) {
		case 01: echo "Dia de Caxias $separador Primeira transmiss�o de TV no Brasil"; break;
		case 03: echo "Dia Mundial do Administrador de Pessoal"; break;
		case 05: echo "Dia da Ecologia $separador Dia Mundial do Meio Ambiente"; break;
		case 07: echo "Dia da Liberdade de Imprensa"; break;
		case 08: echo "Dia do Citricultor $separador Dia do Porteiro"; break;
		case 09: echo "Dia do Tenista $separador Dia da Imuniza��o $separador Dia Nacional de Anchieta"; break;
		case 10: echo "Dia da Artilharia $separador Dia da L�ngua Portuguesa $separador Dia da Ra�a"; break;
		case 11: echo "Dia da Marinha Brasileira $separador Dia do Educador Sanit�rio"; break;
		case 12: echo "Dia do Correio A�reo Nacional $separador Dia dos Namorados"; break;
		case 13: echo "Dia de Santo Ant�nio $separador Dia do Turista"; break;
		case 14: echo "Dia do Solista $separador Dia Universal de Deus"; break;
		case 15: echo "Corpus Christi"; break;
		case 17: echo "Dia do Funcion�rio P�blico Aposentado"; break;
		case 18: echo "Dia do Qu�mico $separador Imigra��o Japonesacase"; break;
		case 19: echo "Dia do Cinema Brasileiro"; break;
		case 20: echo "Dia do Revendedor"; break;
		case 21: echo "Dia da M�dia $separador Dia do Imigrante $separador Dia Universal Ol�mpico $separador In�cio do inverno"; break;
		case 24: echo "Dia das Empresas Gr�ficas $separador Dia de S�o Jo�o $separador Dia Internacional do Leite"; break;
		case 27: echo "Dia Nacional do Progresso"; break;
		case 28: echo "Dia da Renova��o Espiritual"; break;
		case 29: echo "Dia de S�o Pedro e S�o Paulo $separador Dia do Papa $separador Dia da Telefonista $separador Dia do Pescador"; break;
		case 30: echo "Dia do Economista"; break;
	}
}
elseif ($mes == 07) {
	switch($dia) {
		case 01: echo "Dia da vacina BCG"; break;
		case 02: echo "Dia do Hospital $separador Dia do Bombeiro Brasileiro"; break;
		case 04: echo "Dia Internacional do Cooperativismo $separador Independ�ncia dos EUA"; break;
		case 06: echo "Dia da cria��o do IBGE"; break;
		case 08: echo "Dia do Panificador"; break;
		case 09: echo "Dia da Revolu��o e do Soldado Constitucionalista"; break;
		case 10: echo "Dia da Pizza"; break;
		case 13: echo "Dia do Engenheiro de Saneamento $separador Dia do Cantor $separador Dia Mundial do Rock"; break;
		case 14: echo "Dia do Propagandista de Laborat�rio $separador Dia da Liberdade de Pensamento"; break;
		case 15: echo "Dia Nacional dos Clubes"; break;
		case 16: echo "Dia do Comerciante"; break;
		case 17: echo "Dia de Prote��o �s Florestas"; break;
		case 19: echo "Dia da Caridade $separador Dia Nacional do Futebol"; break;
		case 20: echo "Dia do Amigo e Internacional da Amizade $separador Dia da 1� Viagem � Lua (1969)"; break;
		case 23: echo "Dia do Guarda Rodovi�rio"; break;
		case 25: echo "Dia de S�o Crist�v�o $separador Dia do Colono $separador Dia do Escritor $separador Dia do Motorista"; break;
		case 26: echo "Dia da Vov�"; break;
		case 27: echo "Dia do Motociclista"; break;
		case 28: echo "Dia do Agricultor"; break;
	}
}
elseif ($mes == 08) {
	switch($dia) {
		case 01: echo "Dia Nacional do Selo"; break;
		case 03: echo "Dia do Tintureiro"; break;
		case 05: echo "Dia Nacional da Sa�de"; break;
		case 08: echo "Dia do P�roco $separador Dia dos Bandeirantes"; break;
		case 11: echo "Dia da Televis�o $separador Dia do Advogado $separador Dia do Estudante $separador Dia do Gar�om"; break;
		case 12: echo "Dia Nacional da Artes"; break;
		case 13: echo "Dia do Economista $separador Dia dos Pais"; break;
		case 15: echo "Assun��o de Nossa Senhora $separador Dia da Inform�tica $separador Dia dos Solteiros"; break;
		case 19: echo "Dia do Artista de Teatro $separador Dia Mundial da Fotografia"; break;
		case 22: echo "Dia do Folclore"; break;
		case 23: echo "Dia da Injusti�a"; break;
		case 24: echo "Dia da Inf�ncia $separador Dia dos Artistas $separador Dia de S�o Bartolomeu"; break;
		case 25: echo "Dia do Ex�rcito Brasileiro $separador Dia do Feirante $separador Dia do Soldado"; break;
		case 27: echo "Dia do Corretor de Im�veis $separador Dia do Psic�logo"; break;
		case 28: echo "Dia da Avicultura $separador Dia dos Banc�rios"; break;
		case 29: echo "Dia Nacional do Combate do Fumo"; break;
		case 31: echo "Dia da Nutricionista"; break;
	}
}
elseif ($mes == 09) {
	switch($dia) {
		case 01: echo "In�cio da Semana da p�tria"; break;
		case 02: echo "Dia do Rep�rter Fotogr�fico $separador Dia Internacional do Livro Infantil"; break;
		case 03: echo "Dia do Guarda Civil $separador Dia do Bi�logo"; break;
		case 05: echo "Dia Oficial da Farm�cia $separador Dia da Amaz�nia"; break;
		case 06: echo "Dia do Alfaiate $separador Data do Hino Nacional $separador Dia do Barbeiro"; break;
		case 07: echo "Independ�ncia do Brasil"; break;
		case 08: echo "Dia Internacional da Alfabetiza��o"; break;
		case 09: echo "Dia do Administrador $separador Dia do M�dico Veterin�rio $separador Dia da Velocidade"; break;
		case 10: echo "Dia da Imprensa $separador Funda��o do 1� Jornal do Brasil"; break;
		case 13: echo "Dia do Agr�nomo"; break;
		case 14: echo "Dia da Cruz $separador Dia do Frevo"; break;
		case 16: echo "Dia Internacional para a Preserva��o da Camada de Oz�nio"; break;
		case 17: echo "Dia da Compreens�o Mundial"; break;
		case 18: echo "Dia dos S�mbolos Nacionais"; break;
		case 19: echo "Dia de S�o Geraldo $separador Dia do Teatro"; break;
		case 20: echo "Dia do Funcion�rio Municipal $separador Dia do Ga�cho $separador Dia da Pol�cia Civil"; break;
		case 21: echo "Dia da �rvore $separador Dia do Fazendeiro $separador Dia do Radialista"; break;
		case 22: echo "Data da Juventude do Brasil"; break;
		case 23: echo "In�cio da primavera $separador Dia do Soldador"; break;
		case 25: echo "Dia Nacional do Tr�nsito"; break;
		case 26: echo "Dia Interamericano das Rela��es P�blicas"; break;
		case 27: echo "Dia de Cosme e Dami�o $separador Dia do Anci�o $separador Dia do Encanador $separador Dia Mundial de Turismo"; break;
		case 28: echo "Dia da Lei do Ventre Livre"; break;
		case 29: echo "Dia do Anunciante $separador Dia do Petr�leo $separador Dia do Professor de Educa��o F�sica"; break;
		case 30: echo "Dia da Secret�ria $separador Dia da Navega��o $separador Dia Mundial do Tradutor $separador Dia Nacional do Jornaleiro"; break;
	}
}
elseif ($mes == 10) {
	switch($dia) {
		case 01: echo "Dia Internacional da Terceira Idade $separador Dia de Santa Terezinha $separador Dia do Vendedor $separador Dia Nacional do Vereador"; break;
		case 03: echo "Dia Mundial do Dentista $separador Dia do Petr�leo Brasileiro $separador Dia das Abelhas"; break;
		case 04: echo "Dia da Natureza $separador Dia do Barman $separador Dia do C�o $separador Dia do Poeta $separador Dia de S�o Francisco de Assis"; break;
		case 05: echo "Dia das Aves $separador Dia Mundial dos Animais $separador Dia da promulga��o da Constitui��o Brasileira de 1988"; break;
		case 07: echo "Dia do Compositor"; break;
		case 08: echo "Dia do Nordestino"; break;
		case 09: echo "Dia do A�ougueiro e profissionais do setor"; break;
		case 10: echo "Semana da Ci�ncia e Tecnologia $separador Dia Mundial do Lions Clube"; break;
		case 11: echo "Dia do Deficiente F�sico $separador Dia do Teatro Municipal"; break;
		case 12: echo "Dia de Nossa Senhora Aparecida $separador Dia da Crian�a $separador Dia do Atletismo $separador Dia do Engenheiro Agr�nomo $separador Dia do Mar $separador Dia do Descobrimento da Am�rica"; break;
		case 13: echo "Dia do Fisioterapeuta"; break;
		case 14: echo "Dia Nacional da Pecu�ria"; break;
		case 15: echo "Dia do Normalista $separador Dia do Professor"; break;
		case 16: echo "Dia Mundial da Alimenta��o $separador Dia da Ci�ncia e Tecnologia"; break;
		case 17: echo "Dia da Ind�stria Aeron�utica Brasileira $separador Dia do Eletricista"; break;
		case 18: echo "Dia do M�dico $separador Dia do Estivador $separador Dia do Securit�rio $separador Dia do Pintor"; break;
		case 21: echo "Dia do Contato $separador Dia Internacional do Controlador de V�o"; break;
		case 23: echo "Dia da Avia��o e do Aviador"; break;
		case 24: echo "Dia das Na��es Unidas - ONU"; break;
		case 25: echo "Dia da Democracia $separador Dia do Dentista Brasileiro $separador Dia do Sapateiro"; break;
		case 28: echo "Dia de S�o Judas Tadeu $separador Dia do Funcion�rio P�blico"; break;
		case 29: echo "Dia Nacional do Livro"; break;
		case 30: echo "Dia do Balconista $separador Dia do Comerci�rio $separador Dia da Decora��o"; break;
		case 31: echo "Dia Mundial do Comiss�rio de V�o $separador Dia das Bruxas - Halloween"; break;
	}
}
elseif ($mes == 11) {
	switch($dia) {
		case 01: echo "Dia de Todos os Santos"; break;
		case 02: echo "Dia de Finados"; break;
		case 03: echo "Dia do Cabeleireiro $separador Dia do Barbeiro $separador Institui��o do Direito e Voto da Mulher (1930)"; break;
		case 04: echo "Dia do Inventor"; break;
		case 05: echo "Dia da Ci�ncia e Cultura $separador Dia do Cinema Brasileiro $separador Dia do Radioamador e T�cnico Eletr�nica"; break;
		case 08: echo "Dia do Aposentado $separador Dia Mundial do Urbanismo"; break;
		case 09: echo "Dia do Hoteleiro"; break;
		case 10: echo "Dia do Trigo"; break;
		case 11: echo "Dia do Soldado Desconhecido"; break;
		case 12: echo "Dia do Supermercado"; break;
		case 14: echo "Dia do Bandeirante"; break;
		case 15: echo "Proclama��o da Rep�blica $separador Dia Nacional da Alfabetiza��o"; break;
		case 16: echo "Semana da M�sica"; break;
		case 19: echo "Dia da Bandeira"; break;
		case 20: echo "Dia do Auditor Interno $separador Dia Nacional da Consci�ncia Negra $separador Dia do Biom�dico"; break;
		case 21: echo "Dia da Homeopatia $separador Dia das Sauda��es"; break;
		case 22: echo "Dia do M�sico"; break;
		case 23: echo "Dia Internacional do Livro"; break;
		case 25: echo "Dia Nacional do Doador de Sangue"; break;
		case 26: echo "Dia do Minist�rio P�blico"; break;
		case 28: echo "Dia Mundial de A��o de Gra�as"; break;
	}
}
elseif ($mes == 12) {
	switch($dia) {
		case 01: echo "Dia Internacional da Luta contra a AIDS $separador Dia do Imigrante $separador Dia do Numismata"; break;
		case 02: echo "Dia Nacional do Samba $separador Dia da Astronomia $separador Dia Pan-americano da Sa�de $separador Dia Nacional das Rela��es P�blicas"; break;
		case 04: echo "Dia da Propaganda $separador Dia do Pedicuro"; break;
		case 08: echo "Dia Mundial da Imaculada Concei��o $separador Dia da Fam�lia $separador Dia da Justi�a"; break;
		case 09: echo "Dia da Crian�a Defeituosa $separador Dia do Fonoaudi�logo $separador Dia do Alco�lico Recuperado"; break;
		case 10: echo "Declara��o Universal Direitos Humanos $separador Dia Internacional dos Povos Ind�genas $separador Dia Universal do Palha�o"; break;
		case 11: echo "Dia do Arquiteto $separador Dia do Engenheiro $separador Dia do Agr�nomo"; break;
		case 13: echo "Dia do Cego $separador Dia do Marinheiro $separador Dia do �tico"; break;
		case 16: echo "Dia do Reservista"; break;
		case 19: echo "Dia do Atleta Profissional"; break;
		case 20: echo "Dia do Mec�nico"; break;
		case 21: echo "Dia do Atleta"; break;
		case 22: echo "In�cio do ver�o"; break;
		case 23: echo "Dia do Vizinho"; break;
		case 24: echo "Dia do �rf�o"; break;
		case 25: echo "Natal"; break;
		case 26: echo "Dia da Lembran�a"; break;
		case 28: echo "Dia do Salva-vidas"; break;
		case 31: echo "Dia de S�o Silvestre $separador R�veillon"; break;
	}
}
?>
