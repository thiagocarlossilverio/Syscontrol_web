<?php
// -----------------------------------------------------
// Datas Comemorativas 2008
// -----------------------------------------------------
// Desenvolvido por Vitor Martins Santos
// rotiv.nit@gmail.com
// -----------------------------------------------------
// Para usar, coloque:
// include("datas_comemorativas.php");
// no código de sua página onde irá aparecer o dia!
// -----------------------------------------------------


// Escolha como quer separar quando tiver mais de uma 
// comemoração no mesmo dia.
// Por exemplo, se quiser que apareça um em cada linha,
// coloque: <br />
$separador = "|";



$dia = date("d");
$mes = date("m");

if ($mes == 01) {
	switch($dia) {
		case 01: echo "Confraternização Universal $separador Dia Mundial da Paz"; break;
		case 02: echo "Dia da Abreugrafia"; break;
		case 05: echo "Criação da 1ª Tipografia no Brasil"; break;
		case 06: echo "Dia de Reis $separador Dia da Gratidão"; break;
		case 07: echo "Dia da Liberdade de Cultos"; break;
		case 08: echo "Dia do Fotógrafo"; break;
		case 09: echo "Dia do Fico (1822)"; break;
		case 14: echo "Dia do Enfermo"; break;
		case 20: echo "Dia do Museu de Arte Moderna do RJ"; break;
		case 20: echo "Dia do Farmacêutico"; break;
		case 21: echo "Dia Mundial da Religião"; break;
		case 24: echo "Dia da Previdência Social $separador Dia da Constituição $separador Instituição do Casamento civil no Brasil"; break;
		case 25: echo "Dia do Carteiro $separador Fundação de São Paulo $separador Criação dos Correios e Telégrafos no Brasil"; break;
		case 27: echo "Dia da Elevação do Brasil Vice-Reinado (1763)"; break;
		case 28: echo "Dia da Abertura dos Portos (1808)"; break;
		case 30: echo "Dia da Saudade $separador Dia do Portuário $separador Dia Nacional das Histórias em Quadrinhos $separador Dia da Não-Violência"; break;
		case 31: echo "Dia do lançamento do 1º Satélite · EUA (1958)"; break;
	}
}
else if ($mes == 02) {
	switch($dia) {
		case 02: echo "Dia do Agente Fiscal $separador Dia de Iemanjá"; break;
		case 05: echo "Dia do Datiloscopista"; break;
		case 07: echo "Dia do Gráfico"; break;
		case 09: echo "Dia do Zelador"; break;
		case 11: echo "Dia da Criação da Casa de Moeda $separador Dia Mundial do Enfermo"; break;
		case 13: echo "Dia Nacional do Ministério Público"; break;
		case 14: echo "Dia da Amizade"; break;
		case 16: echo "Dia do Repórter"; break;
		case 19: echo "Dia do Esportista"; break;
		case 21: echo "Dia da Conquista do Monte Castelo (1945) $separador Data Festiva do Exército"; break;
		case 23: echo "Dia do Rotaryano"; break;
		case 24: echo "Promulgação da 1ª Constituição Republicana (1891)"; break;
		case 25: echo "Dia da criação do Ministério das Comunicações"; break;
		case 27: echo "Dia dos Idosos $separador Dia do Agente Fiscal da Receita Federal"; break;
		case 28: echo "Carnaval"; break;
	}
}
elseif ($mes == 03) {
	switch($dia) {
		case 02: echo "Dia Nacional do Turismo"; break;
		case 03: echo "Dia do Meteorologista"; break;
		case 05: echo "Dia do Filatelista Brasileiro $separador Dia Mundial da Oração (1ª Sexta-feira do mês)"; break;
		case 07: echo "Dia do Fuzileiros Navais"; break;
		case 08: echo "Dia Internacional da Mulher"; break;
		case 10: echo "Dia do Telefone"; break;
		case 12: echo "Dia do Bibliotecário"; break;
		case 14: echo "Dia do Vendedor de Livros $separador Dia Nacional da Poesia $separador Dia dos Animais"; break;
		case 15: echo "Dia da Escola $separador Dia Mundial do Consumidor"; break;
		case 19: echo "Dia de São José $separador Dia do Carpinteiro $separador Dia do Marceneiro"; break;
		case 20: echo "Início do outono"; break;
		case 21: echo "Dia Universal do Teatro $separador Dia Internacional Contra a Discriminação Racial"; break;
		case 23: echo "Dia Mundial da Meteorologia"; break;
		case 26: echo "Dia do Cacau"; break;
		case 27: echo "Dia do Circo"; break;
		case 28: echo "Dia do Diagramador $separador Revisor"; break;
		case 31: echo "Dia da Integração Nacional $separador Dia da Saúde e Nutrição"; break;
	}
}
elseif ($mes == 04) {
	switch($dia) {
		case 01: echo "Dia da Mentira"; break;
		case 02: echo "Dia do Propagandista"; break;
		case 04: echo "Dia Nacional do Parkinsoniano"; break;
		case 06: echo "Sexta-feira Santa"; break;
		case 07: echo "Dia do Corretor $separador Dia do Jornalismo $separador Dia do Médico Legista $separador Dia Mundial da Saúde"; break;
		case 08: echo "Dia da Natação $separador Dia do Correio $separador Dia Mundial do Combate ao Câncer $separador Páscoa"; break;
		case 09: echo "Dia Nacional do Aço"; break;
		case 10: echo "Dia da Engenharia"; break;
		case 12: echo "Dia do Obstetra"; break;
		case 13: echo "Dia do Office-Boy"; break;
		case 13: echo "Dia dos Jovens"; break;
		case 14: echo "Dia Pan-Americano"; break;
		case 15: echo "Dia da Conservação do Solo $separador Dia Mundial do Desenhista $separador Dia do Desarmamento Infantil"; break;
		case 18: echo "Dia Nacional do Livro Infantil $separador Dia de Monteiro Lobato"; break;
		case 19: echo "Dia do Exército Brasileiro $separador Dia do Índio"; break;
		case 20: echo "Dia do Diplomata"; break;
		case 21: echo "Tiradentes $separador Dia da Latinidade $separador Dia da Polícia Civil $separador Dia do Metalúrgico"; break;
		case 22: echo "Descobrimento do Brasil $separador Dia da Força Aérea Brasileira $separador Dia da Comunidade luso-brasileira"; break;
		case 23: echo "Dia de São Jorge $separador Dia Mundial do Escoteiro"; break;
		case 24: echo "Dia do Agente de Viagem $separador Dia Internacional do Jovem Trabalhador"; break;
		case 25: echo "Dia do Contabilista $separador Dia da ONU"; break;
		case 26: echo "Dia do Goleiro $separador Dia da 1ª Missa no Brasil"; break;
		case 27: echo "Dia da Empregada Doméstica $separador Dia do Sacerdote"; break;
		case 28: echo "Dia da Educação $separador Dia da Sogra"; break;
		case 30: echo "Dia do Ferroviário $separador Dia Nacional da Mulher"; break;
	}
}
elseif ($mes == 05) {
	switch($dia) {
		case 01: echo "Dia Mundial do Trabalho"; break;
		case 02: echo "Dia Nacional do Ex-combatente $separador Dia do Taquígrafo"; break;
		case 03: echo "Dia do Sertanejo"; break;
		case 05: echo "Dia de Rondon $separador Dia da Comunidade $separador Dia Nacional do Expedicionário $separador Dia do Pintor"; break;
		case 06: echo "Dia do Cartógrafo"; break;
		case 07: echo "Dia do Oftalmologista $separador Dia do Silêncio"; break;
		case 08: echo "Dia da Vitória $separador Dia do Profissional Marketing $separador Dia do Artista Plástico $separador Internacional da Cruz Vermelha"; break;
		case 09: echo "Dia da Europa"; break;
		case 10: echo "Dia da Cavalaria $separador Dia do Campo"; break;
		case 11: echo "Integração do Telégrafo no Brasil"; break;
		case 12: echo "Dia Mundial do Enfermeiro"; break;
		case 13: echo "Dia da Ascenção $separador Abolição da Escravatura $separador Dia da Fraternidade Brasileira $separador Dia do Automóvel"; break;
		case 14: echo "Dia das Mães $separador Dia Continental do Seguro"; break;
		case 15: echo "Dia do Assistente Social $separador Dia do Gerente Bancário"; break;
		case 16: echo "Dia do Gari"; break;
		case 17: echo "Dia Internacional da Comunicação e das Telecomunicações $separador Dia da Constituição"; break;
		case 18: echo "Dia dos Vidreiros $separador Dia Internacional dos Museus"; break;
		case 19: echo "Dia dos Acadêmicos do Direito"; break;
		case 20: echo "Dia do Comissário de Menores"; break;
		case 21: echo "Dia da Língua Nacional"; break;
		case 22: echo "Dia do Apicultor"; break;
		case 23: echo "Dia da Juventude Constitucionalista"; break;
		case 24: echo "Dia da Infantaria $separador Dia do Café $separador Dia do Datilógrafo $separador Dia do Detento $separador Dia do Telegrafista $separador Dia do Vestibulando"; break;
		case 25: echo "Dia da Indústria $separador Dia do Massagista $separador Dia do Trabalhador Rural"; break;
		case 27: echo "Ascenção $separador Dia do Profissional Liberal"; break;
		case 29: echo "Dia do Estatístico $separador Dia do Geógrafo"; break;
		case 30: echo "Dia da Decoração $separador Dia do Geólogo $separador Dia das Bandeiras"; break;
		case 31: echo "Dia do Comissário de Bordo $separador Dia Mundial das Comunicações Sociais $separador Dia do Espírito Santo"; break;
	}
}
elseif ($mes == 06) {
	switch($dia) {
		case 01: echo "Dia de Caxias $separador Primeira transmissão de TV no Brasil"; break;
		case 03: echo "Dia Mundial do Administrador de Pessoal"; break;
		case 05: echo "Dia da Ecologia $separador Dia Mundial do Meio Ambiente"; break;
		case 07: echo "Dia da Liberdade de Imprensa"; break;
		case 08: echo "Dia do Citricultor $separador Dia do Porteiro"; break;
		case 09: echo "Dia do Tenista $separador Dia da Imunização $separador Dia Nacional de Anchieta"; break;
		case 10: echo "Dia da Artilharia $separador Dia da Língua Portuguesa $separador Dia da Raça"; break;
		case 11: echo "Dia da Marinha Brasileira $separador Dia do Educador Sanitário"; break;
		case 12: echo "Dia do Correio Aéreo Nacional $separador Dia dos Namorados"; break;
		case 13: echo "Dia de Santo Antônio $separador Dia do Turista"; break;
		case 14: echo "Dia do Solista $separador Dia Universal de Deus"; break;
		case 15: echo "Corpus Christi"; break;
		case 17: echo "Dia do Funcionário Público Aposentado"; break;
		case 18: echo "Dia do Químico $separador Imigração Japonesacase"; break;
		case 19: echo "Dia do Cinema Brasileiro"; break;
		case 20: echo "Dia do Revendedor"; break;
		case 21: echo "Dia da Mídia $separador Dia do Imigrante $separador Dia Universal Olímpico $separador Início do inverno"; break;
		case 24: echo "Dia das Empresas Gráficas $separador Dia de São João $separador Dia Internacional do Leite"; break;
		case 27: echo "Dia Nacional do Progresso"; break;
		case 28: echo "Dia da Renovação Espiritual"; break;
		case 29: echo "Dia de São Pedro e São Paulo $separador Dia do Papa $separador Dia da Telefonista $separador Dia do Pescador"; break;
		case 30: echo "Dia do Economista"; break;
	}
}
elseif ($mes == 07) {
	switch($dia) {
		case 01: echo "Dia da vacina BCG"; break;
		case 02: echo "Dia do Hospital $separador Dia do Bombeiro Brasileiro"; break;
		case 04: echo "Dia Internacional do Cooperativismo $separador Independência dos EUA"; break;
		case 06: echo "Dia da criação do IBGE"; break;
		case 08: echo "Dia do Panificador"; break;
		case 09: echo "Dia da Revolução e do Soldado Constitucionalista"; break;
		case 10: echo "Dia da Pizza"; break;
		case 13: echo "Dia do Engenheiro de Saneamento $separador Dia do Cantor $separador Dia Mundial do Rock"; break;
		case 14: echo "Dia do Propagandista de Laboratório $separador Dia da Liberdade de Pensamento"; break;
		case 15: echo "Dia Nacional dos Clubes"; break;
		case 16: echo "Dia do Comerciante"; break;
		case 17: echo "Dia de Proteção às Florestas"; break;
		case 19: echo "Dia da Caridade $separador Dia Nacional do Futebol"; break;
		case 20: echo "Dia do Amigo e Internacional da Amizade $separador Dia da 1ª Viagem à Lua (1969)"; break;
		case 23: echo "Dia do Guarda Rodoviário"; break;
		case 25: echo "Dia de São Cristóvão $separador Dia do Colono $separador Dia do Escritor $separador Dia do Motorista"; break;
		case 26: echo "Dia da Vovó"; break;
		case 27: echo "Dia do Motociclista"; break;
		case 28: echo "Dia do Agricultor"; break;
	}
}
elseif ($mes == 08) {
	switch($dia) {
		case 01: echo "Dia Nacional do Selo"; break;
		case 03: echo "Dia do Tintureiro"; break;
		case 05: echo "Dia Nacional da Saúde"; break;
		case 08: echo "Dia do Pároco $separador Dia dos Bandeirantes"; break;
		case 11: echo "Dia da Televisão $separador Dia do Advogado $separador Dia do Estudante $separador Dia do Garçom"; break;
		case 12: echo "Dia Nacional da Artes"; break;
		case 13: echo "Dia do Economista $separador Dia dos Pais"; break;
		case 15: echo "Assunção de Nossa Senhora $separador Dia da Informática $separador Dia dos Solteiros"; break;
		case 19: echo "Dia do Artista de Teatro $separador Dia Mundial da Fotografia"; break;
		case 22: echo "Dia do Folclore"; break;
		case 23: echo "Dia da Injustiça"; break;
		case 24: echo "Dia da Infância $separador Dia dos Artistas $separador Dia de São Bartolomeu"; break;
		case 25: echo "Dia do Exército Brasileiro $separador Dia do Feirante $separador Dia do Soldado"; break;
		case 27: echo "Dia do Corretor de Imóveis $separador Dia do Psicólogo"; break;
		case 28: echo "Dia da Avicultura $separador Dia dos Bancários"; break;
		case 29: echo "Dia Nacional do Combate do Fumo"; break;
		case 31: echo "Dia da Nutricionista"; break;
	}
}
elseif ($mes == 09) {
	switch($dia) {
		case 01: echo "Início da Semana da pátria"; break;
		case 02: echo "Dia do Repórter Fotográfico $separador Dia Internacional do Livro Infantil"; break;
		case 03: echo "Dia do Guarda Civil $separador Dia do Biólogo"; break;
		case 05: echo "Dia Oficial da Farmácia $separador Dia da Amazônia"; break;
		case 06: echo "Dia do Alfaiate $separador Data do Hino Nacional $separador Dia do Barbeiro"; break;
		case 07: echo "Independência do Brasil"; break;
		case 08: echo "Dia Internacional da Alfabetização"; break;
		case 09: echo "Dia do Administrador $separador Dia do Médico Veterinário $separador Dia da Velocidade"; break;
		case 10: echo "Dia da Imprensa $separador Fundação do 1º Jornal do Brasil"; break;
		case 13: echo "Dia do Agrônomo"; break;
		case 14: echo "Dia da Cruz $separador Dia do Frevo"; break;
		case 16: echo "Dia Internacional para a Preservação da Camada de Ozônio"; break;
		case 17: echo "Dia da Compreensão Mundial"; break;
		case 18: echo "Dia dos Símbolos Nacionais"; break;
		case 19: echo "Dia de São Geraldo $separador Dia do Teatro"; break;
		case 20: echo "Dia do Funcionário Municipal $separador Dia do Gaúcho $separador Dia da Polícia Civil"; break;
		case 21: echo "Dia da Árvore $separador Dia do Fazendeiro $separador Dia do Radialista"; break;
		case 22: echo "Data da Juventude do Brasil"; break;
		case 23: echo "Início da primavera $separador Dia do Soldador"; break;
		case 25: echo "Dia Nacional do Trânsito"; break;
		case 26: echo "Dia Interamericano das Relações Públicas"; break;
		case 27: echo "Dia de Cosme e Damião $separador Dia do Ancião $separador Dia do Encanador $separador Dia Mundial de Turismo"; break;
		case 28: echo "Dia da Lei do Ventre Livre"; break;
		case 29: echo "Dia do Anunciante $separador Dia do Petróleo $separador Dia do Professor de Educação Física"; break;
		case 30: echo "Dia da Secretária $separador Dia da Navegação $separador Dia Mundial do Tradutor $separador Dia Nacional do Jornaleiro"; break;
	}
}
elseif ($mes == 10) {
	switch($dia) {
		case 01: echo "Dia Internacional da Terceira Idade $separador Dia de Santa Terezinha $separador Dia do Vendedor $separador Dia Nacional do Vereador"; break;
		case 03: echo "Dia Mundial do Dentista $separador Dia do Petróleo Brasileiro $separador Dia das Abelhas"; break;
		case 04: echo "Dia da Natureza $separador Dia do Barman $separador Dia do Cão $separador Dia do Poeta $separador Dia de São Francisco de Assis"; break;
		case 05: echo "Dia das Aves $separador Dia Mundial dos Animais $separador Dia da promulgação da Constituição Brasileira de 1988"; break;
		case 07: echo "Dia do Compositor"; break;
		case 08: echo "Dia do Nordestino"; break;
		case 09: echo "Dia do Açougueiro e profissionais do setor"; break;
		case 10: echo "Semana da Ciência e Tecnologia $separador Dia Mundial do Lions Clube"; break;
		case 11: echo "Dia do Deficiente Físico $separador Dia do Teatro Municipal"; break;
		case 12: echo "Dia de Nossa Senhora Aparecida $separador Dia da Criança $separador Dia do Atletismo $separador Dia do Engenheiro Agrônomo $separador Dia do Mar $separador Dia do Descobrimento da América"; break;
		case 13: echo "Dia do Fisioterapeuta"; break;
		case 14: echo "Dia Nacional da Pecuária"; break;
		case 15: echo "Dia do Normalista $separador Dia do Professor"; break;
		case 16: echo "Dia Mundial da Alimentação $separador Dia da Ciência e Tecnologia"; break;
		case 17: echo "Dia da Indústria Aeronáutica Brasileira $separador Dia do Eletricista"; break;
		case 18: echo "Dia do Médico $separador Dia do Estivador $separador Dia do Securitário $separador Dia do Pintor"; break;
		case 21: echo "Dia do Contato $separador Dia Internacional do Controlador de Vôo"; break;
		case 23: echo "Dia da Aviação e do Aviador"; break;
		case 24: echo "Dia das Nações Unidas - ONU"; break;
		case 25: echo "Dia da Democracia $separador Dia do Dentista Brasileiro $separador Dia do Sapateiro"; break;
		case 28: echo "Dia de São Judas Tadeu $separador Dia do Funcionário Público"; break;
		case 29: echo "Dia Nacional do Livro"; break;
		case 30: echo "Dia do Balconista $separador Dia do Comerciário $separador Dia da Decoração"; break;
		case 31: echo "Dia Mundial do Comissário de Vôo $separador Dia das Bruxas - Halloween"; break;
	}
}
elseif ($mes == 11) {
	switch($dia) {
		case 01: echo "Dia de Todos os Santos"; break;
		case 02: echo "Dia de Finados"; break;
		case 03: echo "Dia do Cabeleireiro $separador Dia do Barbeiro $separador Instituição do Direito e Voto da Mulher (1930)"; break;
		case 04: echo "Dia do Inventor"; break;
		case 05: echo "Dia da Ciência e Cultura $separador Dia do Cinema Brasileiro $separador Dia do Radioamador e Técnico Eletrônica"; break;
		case 08: echo "Dia do Aposentado $separador Dia Mundial do Urbanismo"; break;
		case 09: echo "Dia do Hoteleiro"; break;
		case 10: echo "Dia do Trigo"; break;
		case 11: echo "Dia do Soldado Desconhecido"; break;
		case 12: echo "Dia do Supermercado"; break;
		case 14: echo "Dia do Bandeirante"; break;
		case 15: echo "Proclamação da República $separador Dia Nacional da Alfabetização"; break;
		case 16: echo "Semana da Música"; break;
		case 19: echo "Dia da Bandeira"; break;
		case 20: echo "Dia do Auditor Interno $separador Dia Nacional da Consciência Negra $separador Dia do Biomédico"; break;
		case 21: echo "Dia da Homeopatia $separador Dia das Saudações"; break;
		case 22: echo "Dia do Músico"; break;
		case 23: echo "Dia Internacional do Livro"; break;
		case 25: echo "Dia Nacional do Doador de Sangue"; break;
		case 26: echo "Dia do Ministério Público"; break;
		case 28: echo "Dia Mundial de Ação de Graças"; break;
	}
}
elseif ($mes == 12) {
	switch($dia) {
		case 01: echo "Dia Internacional da Luta contra a AIDS $separador Dia do Imigrante $separador Dia do Numismata"; break;
		case 02: echo "Dia Nacional do Samba $separador Dia da Astronomia $separador Dia Pan-americano da Saúde $separador Dia Nacional das Relações Públicas"; break;
		case 04: echo "Dia da Propaganda $separador Dia do Pedicuro"; break;
		case 08: echo "Dia Mundial da Imaculada Conceição $separador Dia da Família $separador Dia da Justiça"; break;
		case 09: echo "Dia da Criança Defeituosa $separador Dia do Fonoaudiólogo $separador Dia do Alcoólico Recuperado"; break;
		case 10: echo "Declaração Universal Direitos Humanos $separador Dia Internacional dos Povos Indígenas $separador Dia Universal do Palhaço"; break;
		case 11: echo "Dia do Arquiteto $separador Dia do Engenheiro $separador Dia do Agrônomo"; break;
		case 13: echo "Dia do Cego $separador Dia do Marinheiro $separador Dia do Ótico"; break;
		case 16: echo "Dia do Reservista"; break;
		case 19: echo "Dia do Atleta Profissional"; break;
		case 20: echo "Dia do Mecânico"; break;
		case 21: echo "Dia do Atleta"; break;
		case 22: echo "Início do verão"; break;
		case 23: echo "Dia do Vizinho"; break;
		case 24: echo "Dia do Órfão"; break;
		case 25: echo "Natal"; break;
		case 26: echo "Dia da Lembrança"; break;
		case 28: echo "Dia do Salva-vidas"; break;
		case 31: echo "Dia de São Silvestre $separador Réveillon"; break;
	}
}
?>
