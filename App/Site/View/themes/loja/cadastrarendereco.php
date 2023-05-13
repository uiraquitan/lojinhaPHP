<?php

use App\Classes\Message;

Message::seeMessage();
?>
<main class="main">
    <div class="main_home">
        <div class="main_home_menu">
            <?php include(__DIR__ . "/aside.php"); ?>
        </div>

        <div class="main_adrress_div">

            <header class="main_home_header">
                <h1>Cadastrar Endereço</h1>
            </header>

            <form action="<?= URL ?>/loja/updatedadosEndereco/<?= $endereco->id_cliente ?>" method="post">

                <div class="form_loja">
                    <label for="cep">Pais</label>
                    <select name="pais" id="pais">
                        <option value="Afeganistão">Afeganistão</option>
                        <option value="África do Sul">África do Sul</option>
                        <option value="Albânia">Albânia</option>
                        <option value="Alemanha">Alemanha</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Antiga e Barbuda">Antiga e Barbuda</option>
                        <option value="Arábia Saudita">Arábia Saudita</option>
                        <option value="Argélia">Argélia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Arménia">Arménia</option>
                        <option value="Austrália">Austrália</option>
                        <option value="Áustria">Áustria</option>
                        <option value="Azerbaijão">Azerbaijão</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bangladexe">Bangladexe</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Barém">Barém</option>
                        <option value="Bélgica">Bélgica</option>
                        <option value="Belize">Belize</option>
                        <option value="Benim">Benim</option>
                        <option value="Bielorrússia">Bielorrússia</option>
                        <option value="Bolívia">Bolívia</option>
                        <option value="Bósnia e Herzegovina">Bósnia e Herzegovina</option>
                        <option value="Botsuana">Botsuana</option>
                        <option value="Brasil" selected>Brasil</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgária">Bulgária</option>
                        <option value="Burquina Faso">Burquina Faso</option>
                        <option value="Burúndi">Burúndi</option>
                        <option value="Butão">Butão</option>
                        <option value="Cabo Verde">Cabo Verde</option>
                        <option value="Camarões">Camarões</option>
                        <option value="Camboja">Camboja</option>
                        <option value="Canadá">Canadá</option>
                        <option value="Catar">Catar</option>
                        <option value="Cazaquistão">Cazaquistão</option>
                        <option value="Chade">Chade</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Chipre">Chipre</option>
                        <option value="Colômbia">Colômbia</option>
                        <option value="Comores">Comores</option>
                        <option value="Congo-Brazzaville">Congo-Brazzaville</option>
                        <option value="Coreia do Norte">Coreia do Norte</option>
                        <option value="Coreia do Sul">Coreia do Sul</option>
                        <option value="Cosovo">Cosovo</option>
                        <option value="Costa do Marfim">Costa do Marfim</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croácia">Croácia</option>
                        <option value="Cuaite">Cuaite</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Dinamarca">Dinamarca</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Egito">Egito</option>
                        <option value="Emirados Árabes Unidos">Emirados Árabes Unidos</option>
                        <option value="Equador">Equador</option>
                        <option value="Eritreia">Eritreia</option>
                        <option value="Eslováquia">Eslováquia</option>
                        <option value="Eslovénia">Eslovénia</option>
                        <option value="Espanha">Espanha</option>
                        <option value="Essuatíni">Essuatíni</option>
                        <option value="Estado da Palestina">Estado da Palestina</option>
                        <option value="Estados Unidos">Estados Unidos</option>
                        <option value="Estónia">Estónia</option>
                        <option value="Etiópia">Etiópia</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Filipinas">Filipinas</option>
                        <option value="Finlândia">Finlândia</option>
                        <option value="França">França</option>
                        <option value="Gabão">Gabão</option>
                        <option value="Gâmbia">Gâmbia</option>
                        <option value="Gana">Gana</option>
                        <option value="Geórgia">Geórgia</option>
                        <option value="Granada">Granada</option>
                        <option value="Grécia">Grécia</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guiana">Guiana</option>
                        <option value="Guiné">Guiné</option>
                        <option value="Guiné Equatorial">Guiné Equatorial</option>
                        <option value="Guiné-Bissau">Guiné-Bissau</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hungria">Hungria</option>
                        <option value="Iémen">Iémen</option>
                        <option value="Ilhas Marechal">Ilhas Marechal</option>
                        <option value="Índia">Índia</option>
                        <option value="Indonésia">Indonésia</option>
                        <option value="Irão">Irão</option>
                        <option value="Iraque">Iraque</option>
                        <option value="Irlanda">Irlanda</option>
                        <option value="Islândia">Islândia</option>
                        <option value="Israel">Israel</option>
                        <option value="Itália">Itália</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japão">Japão</option>
                        <option value="Jibuti">Jibuti</option>
                        <option value="Jordânia">Jordânia</option>
                        <option value="Laus">Laus</option>
                        <option value="Lesoto">Lesoto</option>
                        <option value="Letónia">Letónia</option>
                        <option value="Líbano">Líbano</option>
                        <option value="Libéria">Libéria</option>
                        <option value="Líbia">Líbia</option>
                        <option value="Listenstaine">Listenstaine</option>
                        <option value="Lituânia">Lituânia</option>
                        <option value="Luxemburgo">Luxemburgo</option>
                        <option value="Macedónia do Norte">Macedónia do Norte</option>
                        <option value="Madagáscar">Madagáscar</option>
                        <option value="Malásia">Malásia</option>
                        <option value="Maláui">Maláui</option>
                        <option value="Maldivas">Maldivas</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marrocos">Marrocos</option>
                        <option value="Maurícia">Maurícia</option>
                        <option value="Mauritânia">Mauritânia</option>
                        <option value="México">México</option>
                        <option value="Mianmar">Mianmar</option>
                        <option value="Micronésia">Micronésia</option>
                        <option value="Moçambique">Moçambique</option>
                        <option value="Moldávia">Moldávia</option>
                        <option value="Mónaco">Mónaco</option>
                        <option value="Mongólia">Mongólia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Namíbia">Namíbia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nicarágua">Nicarágua</option>
                        <option value="Níger">Níger</option>
                        <option value="Nigéria">Nigéria</option>
                        <option value="Noruega">Noruega</option>
                        <option value="Nova Zelândia">Nova Zelândia</option>
                        <option value="Omã">Omã</option>
                        <option value="Países Baixos">Países Baixos</option>
                        <option value="Palau">Palau</option>
                        <option value="Panamá">Panamá</option>
                        <option value="Papua Nova Guiné">Papua Nova Guiné</option>
                        <option value="Paquistão">Paquistão</option>
                        <option value="Paraguai">Paraguai</option>
                        <option value="Peru">Peru</option>
                        <option value="Polónia">Polónia</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Quénia">Quénia</option>
                        <option value="Quirguistão">Quirguistão</option>
                        <option value="Quiribáti">Quiribáti</option>
                        <option value="Reino Unido">Reino Unido</option>
                        <option value="República Centro-Africana">República Centro-Africana</option>
                        <option value="República Checa">República Checa</option>
                        <option value="República Democrática do Congo">República Democrática do Congo</option>
                        <option value="República Dominicana">República Dominicana</option>
                        <option value="Roménia">Roménia</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Rússia">Rússia</option>
                        <option value="Salomão">Salomão</option>
                        <option value="Salvador">Salvador</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Santa Lúcia">Santa Lúcia</option>
                        <option value="São Cristóvão e Neves">São Cristóvão e Neves</option>
                        <option value="São Marinho">São Marinho</option>
                        <option value="São Tomé e Príncipe">São Tomé e Príncipe</option>
                        <option value="São Vicente e Granadinas">São Vicente e Granadinas</option>
                        <option value="Seicheles">Seicheles</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serra Leoa">Serra Leoa</option>
                        <option value="Sérvia">Sérvia</option>
                        <option value="Singapura">Singapura</option>
                        <option value="Síria">Síria</option>
                        <option value="Somália">Somália</option>
                        <option value="Sri Lanca">Sri Lanca</option>
                        <option value="Sudão">Sudão</option>
                        <option value="Sudão do Sul">Sudão do Sul</option>
                        <option value="Suécia">Suécia</option>
                        <option value="Suíça">Suíça</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Tailândia">Tailândia</option>
                        <option value="Taiuã">Taiuã</option>
                        <option value="Tajiquistão">Tajiquistão</option>
                        <option value="Tanzânia">Tanzânia</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trindade e Tobago">Trindade e Tobago</option>
                        <option value="Tunísia">Tunísia</option>
                        <option value="Turcomenistão">Turcomenistão</option>
                        <option value="Turquia">Turquia</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Ucrânia">Ucrânia</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Uruguai">Uruguai</option>
                        <option value="Usbequistão">Usbequistão</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vaticano">Vaticano</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietname">Vietname</option>
                        <option value="Zâmbia">Zâmbia</option>
                        <option value="Zimbábue">Zimbábue</option>
                    </select>
                </div>
                <div class="form_loja">
                    <label for="cep">Cod Postal: </label>
                    <input type="text" id="cep" name="cep" placeholder="CEP" <?= $endereco->cep ?>>
                </div>
                <div class="form_loja">
                    <label for="localidade">Estado: </label>
                    <input type="text" id="uf" name="estado" placeholder="Estado" <?= $endereco->estado ?>>
                </div>

                <div class="form_loja">
                    <label for="bairro">Bairro: </label>
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" <?= $endereco->bairro ?>>
                </div>
                <div class="form_loja">
                    <label for="localidade">Cidade: </label>
                    <input type="text" id="localidade" name="cidade" placeholder="Cidade" <?= $endereco->cidade ?>>
                </div>

                <div class="form_loja">
                    <label for="logradouro">Rua: </label>
                    <input type="text" id="logradouro" name="rua" placeholder="Rua" <?= $endereco->rua ?>>
                </div>

                <div class="form_loja">
                    <label for="numero">Número: </label>
                    <input type="text" id="numero" name="numero" require placeholder="Número" <?= $endereco->numero ?>>
                </div>

                <div class="form_loja">
                    <label for="complemento">Complemento: </label>
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento" <?= $endereco->complemento ?>>
                </div>

                <div class="form_loja">
                    <label for="informacoes_add">Informação: </label>
                    <input type="text" id="informacoes_add" name="informacoes_adicionais" placeholder="Informação adicional" <?= $endereco->informacoes_adicionais ?>>
                </div>


                <div class="form_loja_btn">
                    <input type="submit" class="button" value="Cadastrar Endereço">
                </div>

            </form>
        </div>
    </div>

    </section>

</main>