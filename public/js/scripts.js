/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/scripts.js":
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'));
var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
  return new bootstrap.Offcanvas(offcanvasEl);
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
}); // Configurações do formulario de proposta

var selectNumberContracts = document.querySelectorAll("#numero_contrato");
var reasonDelete = document.getElementById("motivo_exclusao");
var numberAssociate = document.getElementById("numero_associado");
var dateInclusion = document.getElementById("data_inclusao");
var dateDelete = document.getElementById("data_exclusao");
var selectsTypeOperations = document.querySelectorAll('#codigo_tipo_operacao');
selectsTypeOperations.forEach(function (select) {
  select.addEventListener('change', function () {
    var option = select.options[select.selectedIndex].value;

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

function dateProccess(option) {
  var exclusion = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var now = new Date();
  var day = option;
  now.setMonth(now.getMonth() + 1, 1);
  var month = now.getMonth();
  var years = now.getFullYear();

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
    day = day == "01" ? "01" : day == "10" ? "0".concat(day - 1) : day == "20" ? day - 1 : '';
  }

  var dateFull = "".concat(years, "-").concat(month, "-").concat(day);
  return dateFull;
}

selectNumberContracts.forEach(function (select) {
  select.addEventListener('change', function () {
    var option = select.options[select.selectedIndex].getAttribute("data-vigencia");
    var boxDateInclusion = dateInclusion.children[0].children;
    boxDateInclusion[1].value = dateProccess(option);
    var boxDateDelete = dateDelete.children[0].children;
    boxDateDelete[1].value = dateProccess(option, true);
  });
}); // Inclusão de novos dependentes

var dependentes = [{
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
  var dependentes_container = document.querySelector(".main_dependente");

  if (!dependentes_container) {
    return;
  }

  dependentes_container.innerHTML = "";
  dependentes.forEach(function (el) {
    var identificador = el.id;
    var codDependente = el.codDependente;
    var nome = el.nome;
    var cpf = el.cpf;
    var sexo = el.sexo;
    var estadoCivil = el.estadoCivil;
    var nascimento = el.nascimento;
    var filiacao = el.filiacao;
    var numeroUnicoSaude = el.numeroUnicoSaude;
    var numeroDN = el.numeroDN;
    var codigoGrupoCarencia = el.codigoGrupoCarencia;
    var codigoGrupoOdonto = el.codigoGrupoOdonto;
    var dependente_container = " <div class=\"dependente text-start\" data-id=\"".concat(identificador, "\">\n                                  <select name=\"codigo_dependencia[]\" class=\"flex-grow-1\" id=\"codigo_dependencia\">\n                                    <option>Dependencia</option>\n                                    <option value=\"2\" ").concat(codDependente == 2 ? 'selected' : '', ">Companheiro(a)</option>\n                                    <option value=\"3\" ").concat(codDependente == 3 ? 'selected' : '', ">C\xF4njuge</option>\n                                    <option value=\"4\" ").concat(codDependente == 4 ? 'selected' : '', ">Filho</option>\n                                    <option value=\"5\" ").concat(codDependente == 5 ? 'selected' : '', ">Filha</option>\n                                    <option value=\"6\" ").concat(codDependente == 6 ? 'selected' : '', ">Enteado</option>\n                                    <option value=\"7\" ").concat(codDependente == 7 ? 'selected' : '', ">Enteada</option>\n                                    <option value=\"8\" ").concat(codDependente == 8 ? 'selected' : '', ">Pai</option>\n                                    <option value=\"9\" ").concat(codDependente == 9 ? 'selected' : '', ">M\xE3e</option>\n                                  </select>\n                                  <input name=\"nome_dependente[]\" placeholder=\"Nome\" class=\"flex-grow-1\" id=\"nome_dependente\" type=\"text\" value=\"").concat(nome, "\"/>\n                                  <input name=\"cpf_dependente[]\" placeholder=\"CPF\" class=\"flex-grow-1\" id=\"cpf_dependente\" type=\"text\" value=\"").concat(cpf, "\"/>\n                                  <select name=\"sexo_dependente[]\" class=\"flex-grow-1\" id=\"sexo_dependente\">\n                                    <option>Sexo</option>\n                                    <option value=\"M\" ").concat(sexo == 'M' ? 'selected' : '', ">Masculino</option>\n                                    <option value=\"F\" ").concat(sexo == 'F' ? 'selected' : '', ">Feminino</option>\n                                  </select>\n                                  <select name=\"estado_civil_dependente[]\" class=\"flex-grow-1\" id=\"estado_civil_dependente\">\n                                    <option>Estado Civil</option>\n                                    <option value=\"1\" ").concat(estadoCivil == 1 ? 'selected' : '', ">Solteiro</option>\n                                    <option value=\"2\" ").concat(estadoCivil == 2 ? 'selected' : '', ">Casado</option>\n                                    <option value=\"4\" ").concat(estadoCivil == 4 ? 'selected' : '', ">Separado</option>\n                                    <option value=\"5\" ").concat(estadoCivil == 5 ? 'selected' : '', ">Divorciado</option>\n                                    <option value=\"7\" ").concat(estadoCivil == 7 ? 'selected' : '', ">Vi\xFAvo(a)</option>\n                                    <option value=\"8\" ").concat(estadoCivil == 8 ? 'selected' : '', ">Companheiro(a)</option>\n                                    <option value=\"6\" ").concat(estadoCivil == 6 ? 'selected' : '', ">Outros</option>\n                                  </select>\n                                  <input name=\"nascimento_dependente[]\" placeholder=\"Nascimento\" class=\"flex-grow-1\" id=\"nascimento_dependente\" type=\"date\" value=\"").concat(nascimento, "\"/>\n                                  <input name=\"filiacao_dependente[]\" placeholder=\"Filia\xE7\xE3o\" id=\"filiacao_dependente\" class=\"flex-grow-2\" type=\"text\" value=\"").concat(filiacao, "\"/>\n                                  <input type=\"text\" name=\"numero_unico_saude_dependente[]\" id=\"numero_unico_saude\" class=\"flex-grow-1\" placeholder=\"N\xFAmero Unico Sa\xFAde\" value=\"").concat(numeroUnicoSaude, "\" />\n                                  <input type=\"text\" name=\"numero_dn_dependente[]\" id=\"numero_dn\" placeholder=\"N\xFAmero DN\" class=\"flex-grow-1\" value=\"").concat(numeroDN, "\" />\n                                  <select name=\"codigo_grupo_carencia_dependente[]\" id=\"codigo_grupo_carencia_dependente\" class=\"flex-grow-2\">\n                                    <option>Grupo Carencia</option>\n                                    <option value=\"6601\" ").concat(codigoGrupoCarencia == 6601 ? 'selected' : '', ">CARENCIA CA 1</option>\n                                    <option value=\"6602\" ").concat(codigoGrupoCarencia == 6602 ? 'selected' : '', ">CARENCIA CA 2</option>\n                                    <option value=\"6603\" ").concat(codigoGrupoCarencia == 6603 ? 'selected' : '', ">CARENCIA CA 3</option>\n                                  </select>\n                                  <select name=\"codigo_grupo_carencia_odonto_dependente[]\" id=\"codigo_grupo_carencia_odonto_dependente\" class=\"flex-grow-2\">\n                                    <option>Grupo Car\xEAncia Odonto</option>\n                                    <option value=\"8801\" ").concat(codigoGrupoOdonto == 8801 ? 'selected' : '', ">ODONTOLOGICO CPA1</option>\n                                  </select>\n                                  <div class=\"action flex-grow-2\">\n                                    <input type=\"button\" class=\"action-button salvar\" value=\"Salvar\" />\n                                    <input type=\"button\" class=\"action-button bg-danger remover\" value=\"Remover\" />\n                                  </div>\n                                </div>\n                                <hr>");
    dependentes_container.innerHTML += dependente_container;
  });
  salvarDependentes();
  removerDependentes();
  travarOutros(false);
}

function removerDependentes() {
  document.querySelectorAll(".main_dependente .remover").forEach(function (el, i) {
    el.addEventListener("click", function () {
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
  document.querySelectorAll(".main_dependente .salvar").forEach(function (el, i) {
    el.addEventListener("click", function () {
      var identificador = el.parentElement.parentElement.getAttribute("data-id");
      var codDependente = el.parentElement.parentElement.querySelector("#codigo_dependencia").value;
      var nome = el.parentElement.parentElement.querySelector("#nome_dependente").value;
      var cpf = el.parentElement.parentElement.querySelector("#cpf_dependente").value;
      var sexo = el.parentElement.parentElement.querySelector("#sexo_dependente").value;
      var estadoCivil = el.parentElement.parentElement.querySelector("#estado_civil_dependente").value;
      var nascimento = el.parentElement.parentElement.querySelector("#nascimento_dependente").value;
      var filiacao = el.parentElement.parentElement.querySelector("#filiacao_dependente").value;
      var numeroUnicoSaude = el.parentElement.parentElement.querySelector("#numero_unico_saude").value;
      var numeroDN = el.parentElement.parentElement.querySelector("#numero_dn").value;
      var codigoGrupoCarencia = el.parentElement.parentElement.querySelector("#codigo_grupo_carencia_dependente").value;
      var codigoGrupoOdonto = el.parentElement.parentElement.querySelector("#codigo_grupo_carencia_odonto_dependente").value;
      console.log(nome, cpf, filiacao);

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
        codigoGrupoOdonto: codigoGrupoOdonto
      });
      carregarDependentes();
      travarOutros(false);
    });
  });
}

function travarOutros(element) {
  if (element == false) {
    document.querySelectorAll(".main_dependente button, .main_dependente .row > div").forEach(function (el) {
      el.classList.remove("disabled");
    });
    return false;
  }

  document.querySelectorAll(".main_dependente button, .dependentes .row > div").forEach(function (el) {
    if (el != element) {
      el.classList.add("disabled");
    }
  });
} //init


carregarDependentes();
var addDependentes = document.querySelector("#btnAdicionarDependentes");

if (addDependentes) {
  addDependentes.addEventListener("click", adicionarDependentes);
} // API's


var zipcode = document.querySelector("#cep");
var address = document.querySelector("#logradouro");
var complement = document.querySelector("#complemento");
var neighborhood = document.querySelector("#bairro");
var city = document.querySelector("#cidade");
var state = document.querySelector("#uf");

if (zipcode) {
  zipcode.addEventListener('focusout', function () {
    var endpoint = "https://viacep.com.br/ws/".concat(zipcode.value, "/json/");
    var settings = {
      method: 'GET',
      redirect: 'follow'
    };
    fetch(endpoint, settings).then(function (response) {
      return response.json();
    }).then(function (result) {
      address.value = result.logradouro;
      neighborhood.value = result.bairro;
      city.value = result.localidade;
      state.value = result.uf;
    })["catch"](function (error) {
      return console.log('error', error);
    });
  });
}

var btnRemove = document.querySelectorAll('#removeDependent');

if (btnRemove) {
  btnRemove.forEach(function (item) {
    item.addEventListener('click', function () {
      var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      var url = '/Admin/DependentController.php';
      var method = 'PUT';
      var settings = {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": token
        },
        method: method,
        credentials: "same-origin",
        body: JSON.stringify({
          id: item.getAttribute('data-remove')
        })
      };
      fetch(url, settings).then(function (response) {
        return response.text();
      }).then(function (data) {
        console.log(data);
      })["catch"](function (error) {
        return console.log('error', error);
      });
    });
  });
}

/***/ }),

/***/ 2:
/*!***************************************!*\
  !*** multi ./resources/js/scripts.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\movimentacao\resources\js\scripts.js */"./resources/js/scripts.js");


/***/ })

/******/ });