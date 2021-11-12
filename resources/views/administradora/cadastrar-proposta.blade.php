@extends('layout.main')
@section('content')
<!-- multistep form -->
<div class="container vh-100">
  <form id="msform" method="POST" action="{{ route('admin.store.proposta') }}">
    @csrf

    <!-- progressbar -->
    <ul id="progressbar">
      <li class="active">Contrato</li>
      <li>Associado</li>
      <li>Dependentes</li>
      <li>Endereço</li>
      <li>Contato</li>
      <li>Plano</li>
    </ul>

    <!-- fieldsets -->
    <!-- Operação -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-file-contract"></i> Dados da Operação</h2>
      <h3 class="fs-subtitle">Informe os dados da operação</h3>

      <div class="row">
        <div class="col-6">
          <select name="codigo_tipo_operacao" id="codigo_tipo_operacao">
            <option value="">Tipo de Operação</option>
            <option value="1" {{ old('codigo_tipo_operacao') == 1 ? 'selected' : '' }}>INCLUSÃO</option>
            <option value="2" {{ old('codigo_tipo_operacao') == 2 ? 'selected' : '' }}>EXCLUSÃO</option>
            <option value="3" {{ old('codigo_tipo_operacao') == 3 ? 'selected' : '' }}>SUSPENSÃO</option>
          </select>
        </div>
        <div class="col-6">
          <select name="fk_contrato" id="numero_contrato">
            <option value="">Contrato</option>
            <option value="115" data-vigencia="01" {{ old('fk_contrato') == 01 ? 'selected' : '' }}>115 -ASSOC. BRASILEIRA DOS ESTUDANTES</option>
            <option value="116" data-vigencia="01" {{ old('fk_contrato') == 01 ? 'selected' : '' }}>116 - ASSOC. BRASILEIRA DOS ESTUDANTES</option>
            <option value="117" data-vigencia="10" {{ old('fk_contrato') == 10 ? 'selected' : '' }}>117 - ASSOC. BRASILEIRA DOS ESTUDANTES</option>
            <option value="118" data-vigencia="10" {{ old('fk_contrato') == 10 ? 'selected' : '' }}>118 - ASSOC. BRASILEIRA DOS ESTUDANTES</option>
            <option value="119" data-vigencia="20" {{ old('fk_contrato') == 20 ? 'selected' : '' }}>119 - ASSOC. BRASILEIRA DOS ESTUDANTES</option>
            <option value="120" data-vigencia="20" {{ old('fk_contrato') == 20 ? 'selected' : '' }}>120 - ASSOC. BRASILEIRA DOS ESTUDANTES</option>
            <option value="121" data-vigencia="01" {{ old('fk_contrato') == 01 ? 'selected' : '' }}>121 - ASSOC. DOS FUNCIONARIOS DA INDUSTRIA E COMERCIO</option>
            <option value="122" data-vigencia="01" {{ old('fk_contrato') == 01 ? 'selected' : '' }}>122 - ASSOC. DOS FUNCIONARIOS DA INDUSTRIA E COMERCIO</option>
            <option value="123" data-vigencia="10" {{ old('fk_contrato') == 10 ? 'selected' : '' }}>123 - ASSOC. DOS FUNCIONARIOS DA INDUSTRIA E COMERCIO</option>
            <option value="124" data-vigencia="10" {{ old('fk_contrato') == 10 ? 'selected' : '' }}>124 - ASSOC. DOS FUNCIONARIOS DA INDUSTRIA E COMERCIO</option>
            <option value="125" data-vigencia="20" {{ old('fk_contrato') == 20 ? 'selected' : '' }}>125 - ASSOC. DOS FUNCIONARIOS DA INDUSTRIA E COMERCIO</option>
            <option value="126" data-vigencia="20" {{ old('fk_contrato') == 20 ? 'selected' : '' }}>126 - ASSOC. DOS FUNCIONARIOS DA INDUSTRIA E COMERCIO</option>
          </select>
        </div>
        <div class="col-6 d-none" id="numero_associado">
          <input type="text" name="numero_associado_titular" placeholder="Número Associado" value="{{ old('numero_associado_titular') }}" />
        </div>
        <div class="col-6 d-none" id="motivo_exclusao">
          <select name="codigo_motivo_exclusao">
            <option>Motivo da Exclusão</option>
            <option value="1" {{ old('codigo_motivo_exclusao') == 1 ? 'selected' : '' }}>A pedido do beneficiário</option>
            <option value="2" {{ old('codigo_motivo_exclusao') == 2 ? 'selected' : '' }}>Fim da depenpendência a um Titular</option>
            <option value="4" {{ old('codigo_motivo_exclusao') == 3 ? 'selected' : '' }}>Exclusão por inadimplência</option>
            <option value="5" {{ old('codigo_motivo_exclusao') == 5 ? 'selected' : '' }}>Falecimento</option>
            <option value="11" {{ old('codigo_motivo_exclusao') == 11 ? 'selected' : '' }}>Exclusão por Portabilidade</option>
            <option value="50" {{ old('codigo_motivo_exclusao') == 50 ? 'selected' : '' }}>Motivo financeiro</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col d-none" id="data_inclusao">
          <div class="text-start">
            <label class="form-label text-uppercase">Data Inclusão</label>
            <input type="date" name="data_inclusao"value="2020-12-1" disabled />
          </div>
        </div>
        <div class="col d-none" id="data_exclusao">
          <div class="text-start">
            <label class="form-label text-uppercase">Data Exclusão</label>
            <input type="date" name="data_exclusao" value="" data-bs-toggle="tooltip" data-bs-placement="top" title="Tome cuidado com esse campo!" />
          </div>
        </div>
      </div>
      <input type="button" name="next" class="next action-button" value="Próximo" />
    </fieldset>



    <!-- Associado -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-user-alt"></i> Dados do Associado</h2>
      <h3 class="fs-subtitle">Informações básicas do beneficiário</h3>

      <div class="row">
        <div class="col">
          <input type="text" name="nome_associado" placeholder="Nome Associado" value="{{ old('nome_associado') }}" />
        </div>
        <div class="col">
          <input type="text" name="cpf" placeholder="CPF" value="{{ old('cpf') }}" />
        </div>
      </div>

      <div class="row">
        <div class="col">
          <select name="sexo" id="sexo">
            <option>Sexo</option>
            <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Feminino</option>
          </select>
        </div>
        <div class="col">
          <select name="estado_civil" id="estado_civil" class="md-3">
            <option>Estado Civil</option>
            <option value="1" {{ old('estado_civil') == 1 ? 'selected' : '' }}>Solteiro</option>
            <option value="2" {{ old('estado_civil') == 2 ? 'selected' : '' }}>Casado</option>
            <option value="4" {{ old('estado_civil') == 4 ? 'selected' : '' }}>Separado</option>
            <option value="5" {{ old('estado_civil') == 5 ? 'selected' : '' }}>Divorciado</option>
            <option value="7" {{ old('estado_civil') == 7 ? 'selected' : '' }}>Viúvo(a)</option>
            <option value="8" {{ old('estado_civil') == 8 ? 'selected' : '' }}>Companheiro(a)</option>
            <option value="6" {{ old('estado_civil') == 6 ? 'selected' : '' }}>Outros</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" name="filiacao" placeholder="Nome da Mãe" value="{{ old('filiacao') }}" />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="text-start">
            <label class="form-label text-uppercase">Nascimento</label>
            <input type="date" name="nascimento" id="data_nascimento" value="{{ old('nascimento') }}" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <input type="text" name="numero_unico_saude" placeholder="Número Unico Saúde" value="{{ old('numero_unico_saude') }}" />
        </div>
        <div class="col-3">
          <input type="text" name="numero_dn" placeholder="Número DN" value="{{ old('numero_dn') }}" />
        </div>
        <div class="col-3">
          <select name="codigo_grupo_carencia" id="codigo_grupo_carencia">
            <option>Grupo Carencia</option>
            <option value="6601" {{ old('codigo_grupo_carencia') == '6601' ? 'selected' : '' }}>CARENCIA CA 1</option>
            <option value="6602" {{ old('codigo_grupo_carencia') == '6602' ? 'selected' : '' }}>CARENCIA CA 2</option>
            <option value="6603" {{ old('codigo_grupo_carencia') == '6603' ? 'selected' : '' }}>CARENCIA CA 3</option>
          </select>
        </div>
        <div class="col-3">
          <select name="codigoGrupoCarenciaOdonto" id="codigo_grupo_carencia_odonto">
            <option>Grupo Carência Odonto</option>
            <option value="8801" {{ old('codigoGrupoCarenciaOdonto') == '8801' ? 'selected' : '' }}>ODONTOLOGICO CPA1</option>
          </select>
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" name="next" class="next action-button" value="Próximo" />
    </fieldset>


    <!-- Dependente -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-users"></i> Dados do Dependente</h2>
      <h3 class="fs-subtitle">Informe os dados do dependente se houver</h3>
      <div class="row">
        <div class="main_dependente">

        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" class="action-button bg-secondary" id="btnAdicionarDependentes" value="Adicionar" />
      <input type="button" name="next" class="next action-button" value="Próximo" />
    </fieldset>

    <!-- Logradouro -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-map-marker-alt"></i> Endereço</h2>
      <h3 class="fs-subtitle">Informe seu endereço</h3>
      <div class="row">
        <div class="col-2">
          <input type="text" name="cep" placeholder="CEP" id="cep" />
        </div>
        <div class="col-6">
          <input type="text" name="logradouro" placeholder="Logradouro"  />
        </div>
        <div class="col-2">
          <input type="text" name="numero" placeholder="Número" id="numero"  />
        </div>
        <div class="col-2">
          <input type="text" name="complemento" placeholder="Complemento" id="complemento"  />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" name="bairro" placeholder="Bairro" id="bairro"  />
        </div>
        <div class="col">
          <input type="text" name="cidade" placeholder="Cidade" id="cidade"  />
        </div>
        <div class="col">
          <input type="text" name="estado" placeholder="Estado" id="uf"  />
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" name="next" class="next action-button" value="Próximo" />
    </fieldset>

    <!-- Contato -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-envelope"></i> Dados de Contato</h2>
      <h3 class="fs-subtitle">Digite seu e-mail e telefone</h3>
      <div class="row">
        <div class="col">
          <input type="text" name="email" placeholder="E-mail" value="{{ old('email') }}" />
        </div>
        <div class="col">
          <input type="text" name="ddd" placeholder="DDD" value="{{ old('ddd') }}" />
        </div>
        <div class="col">
          <input type="text" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}" />
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" name="next" class="next action-button" value="Próximo" />
    </fieldset>

    <!-- Plano -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-heartbeat"></i> dados do Plano</h2>
      <h3 class="fs-subtitle">Informe os dados pertinente ao plano</h3>
      <div class="row">
        <div class="col">
          <input type="text" name="codigo_empresa" placeholder="Código Empresa" value="{{ old('codigo_empresa') }}" />
        </div>
        <div class="col">
          <select name="codigo_plano" id="codigo_plano">
            <option>Plano Saúde</option>
            <option value="3002" {{ old('codigo_plano') == '3302' ? 'selected' : '' }}>KLINI FÁCIL CA</option>
            <option value="3002" {{ old('codigo_plano') == '3302' ? 'selected' : '' }}>KLINI PRIME CA</option>
          </select>
        </div>
        <div class="col">
          <select name="codigo_plano" id="codigo_plano">
            <option>Plano Dental</option>
            <option value="7002" {{ old('codigo_plano') == '7002' ? 'selected' : '' }}>KLINI DENTAL FACIL CA</option>
            <option value="7003" {{ old('codigo_plano') == '7003' ? 'selected' : '' }}>KLINI DENTAL PRIME CA</option>
          </select>
        </div>
      </div>

      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="submit" class="submit action-button" value="Enviar" />
    </fieldset>
  </form>
</div>
@endsection
