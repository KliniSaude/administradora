const offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'));
const offcanvasList = offcanvasElementList.map(offcanvasEl => {
  return new bootstrap.Offcanvas(offcanvasEl)
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

// Configurações do formulario de proposta
const selectNumberContracts = document.querySelectorAll("#numero_contrato");
const reasonDelete = document.getElementById("motivo_exclusao");
const numberAssociate = document.getElementById("numero_associado");
const dateInclusion = document.getElementById("data_inclusao");
const dateDelete = document.getElementById("data_exclusao");
const selectsTypeOperations = document.querySelectorAll('#codigo_tipo_operacao');

selectsTypeOperations.forEach(select => {
  select.addEventListener('change', () => {
    let option = select.options[select.selectedIndex].value;

    if (!option) {
      return;
    }

    if (option == 1) {
      reasonDelete.remove();
      dateDelete.remove();
      numberAssociate.remove();
      dateInclusion.classList.remove('d-none');
    }

    if (option == 2) {
      dateInclusion.remove();
      reasonDelete.classList.remove('d-none');
      dateDelete.classList.remove('d-none');
      numberAssociate.classList.remove('d-none');
    }

    if (option == 3) {
      return;
    }

  });
});

function dateProccess(option, exclusion = false) {
  const now = new Date();
  let day = option;
  now.setMonth(now.getMonth() + 1, 1);
  let month = now.getMonth();
  let years = now.getFullYear();

  switch (month) {
    case 0:
      month = 1;
      break;
    case 1:
      month = 2;
      break;
    case 2:
      month = 3;
      break;
    case 3:
      month = 4;
      break;
    case 4:
      month = 5;
      break;
    case 5:
      month = 6;
      break;
    case 6:
      month = 7;
      break;
    case 7:
      month = 8;
      break;
    case 8:
      month = 9;
      break;
    case 9:
      month = 10;
      break;
    case 10:
      month = 11;
      break;
    case 11:
      month = 12;
      break;
  }

  if (exclusion == true) {
    day = day == "01" ? "01" : (day == "10" ? `0${day - 1}` : (day == "20" ? day - 1 : ''));
  }

  let dateFull = `${years}-${month}-${day}`;
  return dateFull;
}

selectNumberContracts.forEach(select => {
  select.addEventListener('change', () => {

    const option = select.options[select.selectedIndex].getAttribute("data-vigencia");

    const boxDateInclusion = dateInclusion.children[0].children;
    boxDateInclusion[1].value = dateProccess(option);

    const boxDateDelete = dateDelete.children[0].children;
    boxDateDelete[1].value = dateProccess(option, true);

  });
});

// Inclusão de novos dependentes
let dependentes = [{
  id: "",
  codDependente: "",
  nome: "",
  cpf: "",
  sexo: "",
  estadoCivil: "",
  nascimento: "",
  filiacao: "",
  numeroUnicoSaude: "",
  numeroDN: "",
  codigoGrupoCarencia: "",
  codigoGrupoOdonto: ""
}];

function carregarDependentes() {
  let dependentes_container = document.querySelector(".main_dependente");
  if (!dependentes_container) {
    return;
  }

  dependentes_container.innerHTML = "";
  dependentes.forEach((el) => {
    let identificador = el.id;
    let codDependente = el.codDependente;
    let nome = el.nome;
    let cpf = el.cpf;
    let sexo = el.sexo;
    let estadoCivil = el.estadoCivil;
    let nascimento = el.nascimento;
    let filiacao = el.filiacao;
    let numeroUnicoSaude = el.numeroUnicoSaude;
    let numeroDN = el.numeroDN;
    let codigoGrupoCarencia = el.codigoGrupoCarencia;
    let codigoGrupoOdonto = el.codigoGrupoOdonto;
    let dependente_container = ` <div class="dependente text-start" data-id="${identificador}">
                                  <select name="codigo_dependencia[]" class="flex-grow-1" id="codigo_dependencia">
                                    <option>Dependencia</option>
                                    <option value="2" ${ codDependente == 2 ? 'selected' : ''}>Companheiro(a)</option>
                                    <option value="3" ${ codDependente == 3 ? 'selected' : ''}>Cônjuge</option>
                                    <option value="4" ${ codDependente == 4 ? 'selected' : ''}>Filho</option>
                                    <option value="5" ${ codDependente == 5 ? 'selected' : ''}>Filha</option>
                                    <option value="6" ${ codDependente == 6 ? 'selected' : ''}>Enteado</option>
                                    <option value="7" ${ codDependente == 7 ? 'selected' : ''}>Enteada</option>
                                    <option value="8" ${ codDependente == 8 ? 'selected' : ''}>Pai</option>
                                    <option value="9" ${ codDependente == 9 ? 'selected' : ''}>Mãe</option>
                                  </select>
                                  <input name="nome_dependente[]" placeholder="Nome" class="flex-grow-1" id="nome_dependente" type="text" value="${nome}"/>
                                  <input name="cpf_dependente[]" placeholder="CPF" class="flex-grow-1" id="cpf_dependente" type="text" value="${cpf}"/>
                                  <select name="sexo_dependente[]" class="flex-grow-1" id="sexo_dependente">
                                    <option>Sexo</option>
                                    <option value="M" ${ sexo == 'M' ? 'selected' : ''}>Masculino</option>
                                    <option value="F" ${ sexo == 'F' ? 'selected' : ''}>Feminino</option>
                                  </select>
                                  <select name="estado_civil_dependente[]" class="flex-grow-1" id="estado_civil_dependente">
                                    <option>Estado Civil</option>
                                    <option value="1" ${ estadoCivil == 1 ? 'selected' : ''}>Solteiro</option>
                                    <option value="2" ${ estadoCivil == 2 ? 'selected' : ''}>Casado</option>
                                    <option value="4" ${ estadoCivil == 4 ? 'selected' : ''}>Separado</option>
                                    <option value="5" ${ estadoCivil == 5 ? 'selected' : ''}>Divorciado</option>
                                    <option value="7" ${ estadoCivil == 7 ? 'selected' : ''}>Viúvo(a)</option>
                                    <option value="8" ${ estadoCivil == 8 ? 'selected' : ''}>Companheiro(a)</option>
                                    <option value="6" ${ estadoCivil == 6 ? 'selected' : ''}>Outros</option>
                                  </select>
                                  <input name="nascimento_dependente[]" placeholder="Nascimento" class="flex-grow-1" id="nascimento_dependente" type="date" value="${nascimento}"/>
                                  <input name="filiacao_dependente[]" placeholder="Filiação" id="filiacao_dependente" class="flex-grow-2" type="text" value="${filiacao}"/>
                                  <input type="text" name="numero_unico_saude_dependente[]" id="numero_unico_saude" class="flex-grow-1" placeholder="Número Unico Saúde" value="${numeroUnicoSaude}" />
                                  <input type="text" name="numero_dn_dependente[]" id="numero_dn" placeholder="Número DN" class="flex-grow-1" value="${numeroDN}" />
                                  <select name="codigo_grupo_carencia_dependente[]" id="codigo_grupo_carencia_dependente" class="flex-grow-2">
                                    <option>Grupo Carencia</option>
                                    <option value="6601" ${ codigoGrupoCarencia == 6601 ? 'selected' : ''}>CARENCIA CA 1</option>
                                    <option value="6602" ${ codigoGrupoCarencia == 6602 ? 'selected' : ''}>CARENCIA CA 2</option>
                                    <option value="6603" ${ codigoGrupoCarencia == 6603 ? 'selected' : ''}>CARENCIA CA 3</option>
                                  </select>
                                  <select name="codigo_grupo_carencia_odonto_dependente[]" id="codigo_grupo_carencia_odonto_dependente" class="flex-grow-2">
                                    <option>Grupo Carência Odonto</option>
                                    <option value="8801" ${ codigoGrupoOdonto == 8801 ? 'selected' : ''}>ODONTOLOGICO CPA1</option>
                                  </select>
                                  <div class="action flex-grow-2">
                                    <input type="button" class="action-button salvar" value="Salvar" />
                                    <input type="button" class="action-button bg-danger remover" value="Remover" />
                                  </div>
                                </div>
                                <hr>`;

    dependentes_container.innerHTML += dependente_container;
  });
  salvarDependentes();
  removerDependentes();
  travarOutros(false);
}

function removerDependentes() {
  document.querySelectorAll(".main_dependente .remover").forEach((el, i) => {
    el.addEventListener("click", () => {
      dependentes.splice(i, 1);
      carregarDependentes();
    });
  });
}

function adicionarDependentes() {
  dependentes.push({
    id: "",
    codDependente: "",
    nome: "",
    cpf: "",
    sexo: "",
    estadoCivil: "",
    nascimento: "",
    filiacao: "",
    numeroUnicoSaude: "",
    numeroDN: "",
    codigoGrupoCarencia: "",
    codigoGrupoOdonto: ""
  });
  carregarDependentes();
  travarOutros(document.querySelector(".main_dependente > div:last-child"));
}

function salvarDependentes() {
  document.querySelectorAll(".main_dependente .salvar").forEach((el, i) => {
    el.addEventListener("click", () => {
      let identificador = el.parentElement.parentElement.getAttribute("data-id");
      let codDependente = el.parentElement.parentElement.querySelector("#codigo_dependencia").value;
      let nome = el.parentElement.parentElement.querySelector("#nome_dependente").value;
      let cpf = el.parentElement.parentElement.querySelector("#cpf_dependente").value;
      let sexo = el.parentElement.parentElement.querySelector("#sexo_dependente").value;
      let estadoCivil = el.parentElement.parentElement.querySelector("#estado_civil_dependente").value;
      let nascimento = el.parentElement.parentElement.querySelector("#nascimento_dependente").value;
      let filiacao = el.parentElement.parentElement.querySelector("#filiacao_dependente").value;
      let numeroUnicoSaude = el.parentElement.parentElement.querySelector("#numero_unico_saude").value;
      let numeroDN = el.parentElement.parentElement.querySelector("#numero_dn").value;
      let codigoGrupoCarencia = el.parentElement.parentElement.querySelector("#codigo_grupo_carencia_dependente").value;
      let codigoGrupoOdonto = el.parentElement.parentElement.querySelector("#codigo_grupo_carencia_odonto_dependente").value;

      console.log(nome,cpf,filiacao);

      if (!nome.length || !cpf.length) {
        alert("Nome e idade precisam ser preenchidos para salvar.");
        return false;
      }
      dependentes.splice(i, 1, {
        identificador: identificador,
        codDependente: codDependente,
        nome: nome,
        cpf: cpf,
        sexo: sexo,
        estadoCivil: estadoCivil,
        nascimento: nascimento,
        filiacao: filiacao,
        numeroUnicoSaude: numeroUnicoSaude,
        numeroDN: numeroDN,
        codigoGrupoCarencia: codigoGrupoCarencia,
        codigoGrupoOdonto: codigoGrupoOdonto,
      });
      carregarDependentes();
      travarOutros(false);
    });
  });
}

function travarOutros(element) {
  if (element == false) {
    document.querySelectorAll(".main_dependente button, .main_dependente .row > div").forEach((el) => {
      el.classList.remove("disabled");
    });
    return false;
  }
  document.querySelectorAll(".main_dependente button, .dependentes .row > div").forEach((el) => {
    if (el != element) {
      el.classList.add("disabled");
    }
  });
}

//init
carregarDependentes();

let addDependentes = document.querySelector("#btnAdicionarDependentes")
if (addDependentes) {
  addDependentes.addEventListener("click", adicionarDependentes);
}


// API's
const zipcode = document.querySelector("#cep");
const address = document.querySelector("#logradouro");
const complement = document.querySelector("#complemento");
const neighborhood = document.querySelector("#bairro");
const city = document.querySelector("#cidade");
const state = document.querySelector("#uf");

if (zipcode) {
  zipcode.addEventListener('focusout', () => {

    const endpoint = `https://viacep.com.br/ws/${zipcode.value}/json/`;
    const settings = {
      method: 'GET',
      redirect: 'follow'
    }


    fetch(endpoint, settings)
      .then(response => response.json())
      .then(result => {
        address.value = result.logradouro
        neighborhood.value = result.bairro
        city.value = result.localidade
        state.value = result.uf
      })
      .catch(error => console.log('error', error));

  });
}


