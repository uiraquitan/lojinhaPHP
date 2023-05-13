<main class="main">
    <!-- <section class="main_slide_top">
            slide
        </section> -->
    <section class="main_section_new">
        <header class="main_section_new_header">

            <h1>Alterar Dados</h1>
        </header>
        <?php

        use App\Classes\Message;

        Message::seeMessage();
        ?>

        <div class="update_dados">
            <form action="<?= URL ?>/user/dadosAtualizar" method="post">
                <header>
                    <h2>Alterar dados</h2>
                    <p><i class="fa-solid fa-bars"></i></p>
                </header>
                <div class="form_div">
                    <label for="senha">Email: </label>
                    <input type="text" id="email" name="email" placeholder="E-mail">
                </div>
                <div class="form_div">
                    <label for="ddd">DDD: </label>
                    <select name="ddd" id="ddd">
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="24">24</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                        <option value="45">45</option>
                        <option value="46">46</option>
                        <option value="47">47</option>
                        <option value="48">48</option>
                        <option value="49">49</option>
                        <option value="51">51</option>
                        <option value="53">53</option>
                        <option value="54">54</option>
                        <option value="55">55</option>
                        <option value="61">61</option>
                        <option value="62">62</option>
                        <option value="63">63</option>
                        <option value="64">64</option>
                        <option value="65">65</option>
                        <option value="66">66</option>
                        <option value="67">67</option>
                        <option value="68">68</option>
                        <option value="69">69</option>
                        <option value="71">71</option>
                        <option value="73">73</option>
                        <option value="74">74</option>
                        <option value="75">75</option>
                        <option value="77">77</option>
                        <option value="79">79</option>
                        <option value="81">81</option>
                        <option value="82">82</option>
                        <option value="83">83</option>
                        <option value="84">84</option>
                        <option value="85">85</option>
                        <option value="86">86</option>
                        <option value="87">87</option>
                        <option value="88">88</option>
                        <option value="89">89</option>
                        <option value="91">91</option>
                        <option value="92">92</option>
                        <option value="93">93</option>
                        <option value="94">94</option>
                        <option value="95">95</option>
                        <option value="96">96</option>
                        <option value="97">97</option>
                        <option value="98">98</option>
                        <option value="99">99</option>
                    </select>
                </div>
                <div class="form_div">
                    <label for="senha">Telefone: </label>
                    <input type="text" id="telefone" name="phone" placeholder="Telefone">
                </div>

                <div class="form_div_btn">
                <input type="submit" class="button" value="Atualizar Dados">
                </div>

            </form>

            <form action="<?= URL ?>/user/updatedadosEndereco" method="post">
                <header>
                    <h2>Alterar Endereço</h2>
                    <p><i class="fa-solid fa-bars"></i></p>
                </header>
                <div class="form_div">
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
                <div class="form_div">
                    <label for="cep">Cod Postal: </label>
                    <input type="text" id="cep" name="cep" placeholder="CEP">
                </div>
                <div class="form_div">
                    <label for="localidade">Estado: </label>
                    <input type="text" id="uf" name="estado" placeholder="Estado">
                </div>

                <div class="form_div">
                    <label for="bairro">Bairro: </label>
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro">
                </div>
                <div class="form_div">
                    <label for="localidade">Cidade: </label>
                    <input type="text" id="localidade" name="cidade" placeholder="Cidade">
                </div>

                <div class="form_div">
                    <label for="logradouro">Rua: </label>
                    <input type="text" id="logradouro" name="rua" placeholder="Rua">
                </div>

                <div class="form_div">
                    <label for="numero">Número: </label>
                    <input type="text" id="numero" name="numero" require placeholder="Número">
                </div>

                <div class="form_div">
                    <label for="complemento">Complemento: </label>
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento">
                </div>

                <div class="form_div">
                    <label for="informacoes_add">Informação Adicional: </label>
                    <input type="text" id="informacoes_add" name="informacoes_adicionais" placeholder="Informação adicional">
                </div>


                <div class="form_div_btn">
                    <input type="submit" class="button" value="Cadastrar Endereço">
                </div>

            </form>
        </div>

    </section>
    <?php include(__DIR__ . "/dobra_um.php"); ?>
</main>