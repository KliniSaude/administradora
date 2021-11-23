@extends('layout.main')
@section('content')
<!-- multistep form -->
<div class="container ">
  <form id="msform" method="POST" action="{{ route('admin.update.proposta', ['id' => $propose->id]) }}">
    @csrf
    @method('PUT')
    <!-- progressbar -->
    <ul id="progressbar">
      <li class="active">Contrato</li>
      <li>Associado</li>
      <li>Dependentes</li>
      <li>Endereço</li>
      <li>Contato</li>
      <li>Plano</li>
    </ul>

    @if ($errors->any())
    <div class="col-6 my-3 mx-auto alert alert-success bg-danger text-white" role="alert">
      <h4 class="alert-heading">Ooppss...</h4>
      @foreach ($errors->all() as $error)
      <p class="mb-0">{{ $error }}</p>
      @endforeach
    </div>
    @endif

    <!-- fieldsets -->
    <!-- Operação -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-file-contract"></i> Dados da Operação</h2>
      <h3 class="fs-subtitle">Informe os dados da operação</h3>

      <div class="row">
        <div class="col-6">
          <select name="codigo_tipo_operacao" id="codigo_tipo_operacao">
            <option value="">Tipo de Operação</option>
            <option value="1" {{ $propose->codigo_tipo_operacao == '1' ? 'selected' : (old('codigo_tipo_operacao') == '1' ? 'selected' : '') }}>INCLUSÃO</option>
            <option value="2" {{ $propose->codigo_tipo_operacao == '2' ? 'selected' : (old('codigo_tipo_operacao') == '2' ? 'selected' : '') }}>EXCLUSÃO</option>
            <option value="3" {{ $propose->codigo_tipo_operacao == '3' ? 'selected' : (old('codigo_tipo_operacao') == '3' ? 'selected' : '') }}>SUSPENSÃO</option>
          </select>
        </div>
        <div class="col-6">
          <select name="fk_contrato" id="numero_contrato">
            <option value="">Contrato</option>
            @foreach ($entities as $entity)
            <option value="{{ $entity->contrato }}" {{ $propose->fk_contrato == $entity->contrato ? 'selected' : (old('fk_contrato') == $entity->contrato ? 'selected' : '') }} data-vigencia="{{ $entity->data }}" >{{ $entity->contrato }} - {{ $entity->nome_entidade }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-6 d-none" id="numero_associado">
          <input type="text" name="numero_associado_titular" placeholder="Número Associado" value="{{ old('numero_associado_titular') }}" />
        </div>
        <div class="col-6 d-none" id="motivo_exclusao">
          <select name="codigo_motivo_exclusao">
            <option>Motivo da Exclusão</option>
            <option value="1" {{ $propose->codigo_motivo_exclusao == '1' ? 'selected' : (old('codigo_motivo_exclusao') == '1' ? 'selected' : '') }}>A pedido do beneficiário</option>
            <option value="2" {{ $propose->codigo_motivo_exclusao == '2' ? 'selected' : (old('codigo_motivo_exclusao') == '2' ? 'selected' : '') }}>Fim da depenpendência a um Titular</option>
            <option value="4" {{ $propose->codigo_motivo_exclusao == '4' ? 'selected' : (old('codigo_motivo_exclusao') == '4' ? 'selected' : '') }}>Exclusão por inadimplência</option>
            <option value="5" {{ $propose->codigo_motivo_exclusao == '5' ? 'selected' : (old('codigo_motivo_exclusao') == '5' ? 'selected' : '') }}>Falecimento</option>
            <option value="11" {{ $propose->codigo_motivo_exclusao == '11' ? 'selected' : (old('codigo_motivo_exclusao') == '11' ? 'selected' : '') }}>Exclusão por Portabilidade</option>
            <option value="50" {{ $propose->codigo_motivo_exclusao == '50' ? 'selected' : (old('codigo_motivo_exclusao') == '50' ? 'selected' : '') }}>Motivo financeiro</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col d-none" id="data_inclusao">
          <div class="text-start">
            <label class="form-label text-uppercase">Data Inclusão</label>
            <input type="date" name="data_inclusao" value="{{ $propose->data_inclusao != '' ? $propose->data_inclusao : old('data_inclusao') }}" />
          </div>
        </div>
        <div class="col d-none" id="data_exclusao">
          <div class="text-start">
            <label class="form-label text-uppercase">Data Exclusão</label>
            <input type="date" name="data_exclusao" value="{{ $propose->data_exclusao != '' ? $propose->data_exclusao : old('data_exclusao') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Atenção ao editar esse campo, em caso de dúvidas entre em contato com o suporte" />
          </div>
        </div>
      </div>
      <input type="button" name="next" class="next action-button" dusk="NextButtonStep1" value="Próximo" />
    </fieldset>



    <!-- Associado -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-user-alt"></i> Dados do Associado</h2>
      <h3 class="fs-subtitle">Informações básicas do beneficiário</h3>

      <div class="row">
        <div class="col">
          <input type="text" name="nome_associado" placeholder="Nome Associado" value="{{ $propose->nome_associado != '' ? $propose->nome_associado : old('nome_associado') }}" />
        </div>
        <div class="col">
          <input type="text" name="cpf" placeholder="CPF" value="{{ $propose->cpf != '' ? $propose->cpf : old('cpf') }}" />
        </div>
      </div>

      <div class="row">
        <div class="col">
          <select name="sexo" id="sexo">
            <option>Sexo</option>
            <option value="M" {{ $propose->sexo == 'M' ? 'selected' : (old('sexo') == 'M' ? 'selected' : '') }}>Masculino</option>
            <option value="F" {{ $propose->sexo == 'F' ? 'selected' : (old('sexo') == 'F' ? 'selected' : '') }}>Feminino</option>
          </select>
        </div>
        <div class="col">
          <select name="estado_civil" id="estado_civil" class="md-3">
            <option>Estado Civil</option>
            <option value="1" {{ $propose->estado_civil == 1 ? 'selected' : (old('estado_civil') == 1 ? 'selected' : '') }}>Solteiro</option>
            <option value="2" {{ $propose->estado_civil == 2 ? 'selected' : (old('estado_civil') == 2 ? 'selected' : '') }}>Casado</option>
            <option value="4" {{ $propose->estado_civil == 4 ? 'selected' : (old('estado_civil') == 4 ? 'selected' : '') }}>Separado</option>
            <option value="5" {{ $propose->estado_civil == 5 ? 'selected' : (old('estado_civil') == 5 ? 'selected' : '') }}>Divorciado</option>
            <option value="7" {{ $propose->estado_civil == 7 ? 'selected' : (old('estado_civil') == 7 ? 'selected' : '') }}>Viúvo(a)</option>
            <option value="8" {{ $propose->estado_civil == 8 ? 'selected' : (old('estado_civil') == 8 ? 'selected' : '') }}>Companheiro(a)</option>
            <option value="6" {{ $propose->estado_civil == 6 ? 'selected' : (old('estado_civil') == 6 ? 'selected' : '') }}>Outros</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" name="filiacao" placeholder="Nome da Mãe" value="{{ $propose->filiacao != '' ? $propose->filiacao : old('filiacao') }}" />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="text-start">
            <label class="form-label text-uppercase">Nascimento</label>
            <input type="date" name="nascimento" id="data_nascimento" value="{{ $propose->nascimento != '' ? $propose->nascimento : old('nascimento') }}" />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <input type="text" name="numero_unico_saude" placeholder="Número Unico Saúde" value="{{ $propose->numero_unico_saude != '' ? $propose->numero_unico_saude : old('numero_unico_saude') }}" />
        </div>
        <div class="col-3">
          <input type="text" name="numero_dn" placeholder="Número DN" value="{{ $propose->numero_dn != '' ? $propose->numero_dn : old('numero_dn') }}" />
        </div>
        <div class="col-3">
          <select name="codigo_grupo_carencia" id="codigo_grupo_carencia">
            <option>Grupo Carencia</option>
            <option value="6601" {{ $propose->codigo_grupo_carencia == '6601' ? 'selected' : (old('codigo_grupo_carencia') == '6601' ? 'selected' : '') }}>CARENCIA CA 1</option>
            <option value="6602" {{ $propose->codigo_grupo_carencia == '6602' ? 'selected' : (old('codigo_grupo_carencia') == '6602' ? 'selected' : '') }}>CARENCIA CA 2</option>
            <option value="6603" {{ $propose->codigo_grupo_carencia == '6603' ? 'selected' : (old('codigo_grupo_carencia') == '6603' ? 'selected' : '') }}>CARENCIA CA 3</option>
          </select>
        </div>
        <div class="col-3">
          <select name="codigoGrupoCarenciaOdonto" id="codigo_grupo_carencia_odonto">
            <option>Grupo Carência Odonto</option>
            <option value="8801" {{ $propose->codigoGrupoCarenciaOdonto == '8801' ? 'selected' : (old('codigoGrupoCarenciaOdonto') == '8801' ? 'selected' : '') }}>ODONTOLOGICO CPA1</option>
          </select>
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" name="next" class="next action-button" dusk="NextButtonStep2" value="Próximo" />
    </fieldset>


    <!-- Dependente -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-users"></i> Dados do Dependente</h2>
      <h3 class="fs-subtitle">Informe os dados do dependente se houver</h3>
      <div class="row">

        <div class="alert alert-success bg-success text-white d-none" id="message" role="alert">

        </div>

        <div class="">
          @if (!isset($dependents))
          <div class="main_dependente">

          </div>
          @else
          @foreach ($dependents as $dependent)
              <div class="dependente text-start" data-id="">
                <input type="hidden" name="id_dependente[]" value="{{ $dependent->id }}">
                <select name="codigo_dependencia[]" class="flex-grow-1" id="codigo_dependencia">
                  <option>Dependencia</option>
                  <option value="2" {{ $dependent->codigo_dependencia == 2 ? 'selected' : '' }}>Companheiro(a)</option>
                  <option value="3" {{ $dependent->codigo_dependencia == 3 ? 'selected' : '' }}>Cônjuge</option>
                  <option value="4" {{ $dependent->codigo_dependencia == 4 ? 'selected' : '' }}>Filho</option>
                  <option value="5" {{ $dependent->codigo_dependencia == 5 ? 'selected' : '' }}>Filha</option>
                  <option value="6" {{ $dependent->codigo_dependencia == 6 ? 'selected' : '' }}>Enteado</option>
                  <option value="7" {{ $dependent->codigo_dependencia == 7 ? 'selected' : '' }}>Enteada</option>
                  <option value="8" {{ $dependent->codigo_dependencia == 8 ? 'selected' : '' }}>Pai</option>
                  <option value="9" {{ $dependent->codigo_dependencia == 9 ? 'selected' : '' }}>Mãe</option>
                </select>
                <input name="nome_dependente[]" placeholder="Nome" class="flex-grow-1" id="nome_dependente" type="text" value="{{ $dependent->nome_dependente }}"/>
                <input name="cpf_dependente[]" placeholder="CPF" class="flex-grow-1" id="cpf_dependente" type="text" value="{{ $dependent->cpf_dependente }}"/>
                <select name="sexo_dependente[]" class="flex-grow-1" id="sexo_dependente">
                  <option>Sexo</option>
                  <option value="M" {{ $dependent->sexo_dependente == 'M' ? 'selected' : '' }}>Masculino</option>
                  <option value="F" {{ $dependent->sexo_dependente == 'F' ? 'selected' : '' }}>Feminino</option>
                </select>
                <select name="estado_civil_dependente[]" class="flex-grow-1" id="estado_civil_dependente">
                  <option>Estado Civil</option>
                  <option value="1" {{ $dependent->estado_civil_dependente == '1' ? 'selected' : '' }}>Solteiro</option>
                  <option value="2" {{ $dependent->estado_civil_dependente == '2' ? 'selected' : '' }}>Casado</option>
                  <option value="4" {{ $dependent->estado_civil_dependente == '4' ? 'selected' : '' }}>Separado</option>
                  <option value="5" {{ $dependent->estado_civil_dependente == '5' ? 'selected' : '' }}>Divorciado</option>
                  <option value="7" {{ $dependent->estado_civil_dependente == '7' ? 'selected' : '' }}>Viúvo(a)</option>
                  <option value="8" {{ $dependent->estado_civil_dependente == '8' ? 'selected' : '' }}>Companheiro(a)</option>
                  <option value="6" {{ $dependent->estado_civil_dependente == '6' ? 'selected' : '' }}>Outros</option>
                </select>
                <input name="nascimento_dependente[]" placeholder="Nascimento" class="flex-grow-1" id="nascimento_dependente" type="date" value="{{ $dependent->nascimento_dependente }}"/>
                <input name="filiacao_dependente[]" placeholder="Filiação" id="filiacao_dependente" class="flex-grow-2" type="text" value="{{ $dependent->filiacao_dependente }}"/>
                <input type="text" name="numero_unico_saude_dependente[]" id="numero_unico_saude" class="flex-grow-1" placeholder="Número Unico Saúde" value="{{ $dependent->numero_unico_saude_dependente }}" />
                <input type="text" name="numero_dn_dependente[]" id="numero_dn" placeholder="Número DN" class="flex-grow-1" value="{{ $dependent->numero_dn_dependente }}" />
                <select name="codigo_grupo_carencia_dependente[]" id="codigo_grupo_carencia_dependente" class="flex-grow-2">
                  <option>Grupo Carencia</option>
                  <option value="6601" {{ $dependent->codigo_grupo_carencia_dependente == '6601' ? 'selected' : '' }}>CARENCIA CA 1</option>
                  <option value="6602" {{ $dependent->codigo_grupo_carencia_dependente == '6602' ? 'selected' : '' }}>CARENCIA CA 2</option>
                  <option value="6603" {{ $dependent->codigo_grupo_carencia_dependente == '6603' ? 'selected' : '' }}>CARENCIA CA 3</option>
                </select>
                <select name="codigo_grupo_carencia_odonto_dependente[]" id="codigo_grupo_carencia_odonto_dependente" class="flex-grow-2">
                  <option>Grupo Carência Odonto</option>
                  <option value="8801" {{ $dependent->codigo_grupo_carencia_odonto_dependente == '8801' ? 'selected' : '' }}>ODONTOLOGICO CPA1</option>
                </select>
                <div class="action flex-grow-2">
                  <input type="button" class="action-button bg-danger remover" id="removeDependent" data-remove="{{ $dependent->id }}" value="Remover" />
                </div>
              </div>
              <hr>
            @endforeach
          @endif
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" class="action-button bg-secondary" id="btnAdicionarDependentes" value="Adicionar" />
      <input type="button" name="next" class="next action-button" dusk="NextButtonStep3" value="Próximo" />
    </fieldset>

    <!-- Logradouro -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-map-marker-alt"></i> Endereço</h2>
      <h3 class="fs-subtitle">Informe seu endereço</h3>
      <div class="row">
        <div class="col-2">
          <input type="text" name="cep" placeholder="CEP" id="cep" value="{{ $propose->cep != '' ? $propose->cep : old('cep') }}" />
        </div>
        <div class="col-6">
          <input type="text" name="logradouro" placeholder="Logradouro" id="logradouro" value="{{ $propose->logradouro != '' ? $propose->logradouro : old('logradouro') }}"  />
        </div>
        <div class="col-2">
          <input type="text" name="numero" placeholder="Número" id="numero" value="{{ $propose->numero != '' ? $propose->numero : old('numero') }}"  />
        </div>
        <div class="col-2">
          <input type="text" name="complemento" placeholder="Complemento" id="complemento" value="{{ $propose->complemento != '' ? $propose->complemento : old('complemento') }}"  />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" name="bairro" placeholder="Bairro" id="bairro" value="{{ $propose->bairro != '' ? $propose->bairro : old('bairro') }}"  />
        </div>
        <div class="col">
          <input type="text" name="cidade" placeholder="Cidade" id="cidade" value="{{ $propose->cidade != '' ? $propose->cidade : old('cidade') }}" />
        </div>
        <div class="col">
          <input type="text" name="estado" placeholder="Estado" id="uf" value="{{ $propose->estado != '' ? $propose->estado : old('estado') }}"  />
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" name="next" class="next action-button" dusk="NextButtonStep4" value="Próximo" />
    </fieldset>

    <!-- Contato -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-envelope"></i> Dados de Contato</h2>
      <h3 class="fs-subtitle">Digite seu e-mail e telefone</h3>
      <div class="row">
        <div class="col">
          <input type="text" name="email" placeholder="E-mail" value="{{ $propose->email != '' ? $propose->email : old('email') }}" />
        </div>
        <div class="col">
          <input type="text" name="ddd" placeholder="DDD" value="{{ $propose->ddd != '' ? $propose->ddd : old('ddd') }}" />
        </div>
        <div class="col">
          <input type="text" name="telefone" placeholder="Telefone" value="{{ $propose->telefone != '' ? $propose->telefone : old('telefone') }}" />
        </div>
      </div>
      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="button" name="next" class="next action-button" dusk="NextButtonStep5" value="Próximo" />
    </fieldset>

    <!-- Plano -->
    <fieldset>
      <h2 class="fs-title"><i class="fas fa-heartbeat"></i> dados do Plano</h2>
      <h3 class="fs-subtitle">Informe os dados pertinente ao plano</h3>
      <div class="row">
        <div class="col">
          <input type="text" name="codigo_empresa" placeholder="Código Empresa" value="{{ $propose->codigo_empresa != '' ? $propose->codigo_empresa : old('codigo_empresa') }}" />
        </div>
        <div class="col">
          <select name="codigo_plano" id="codigo_plano">
            <option>Plano Saúde</option>
            <option value="3002" {{ $propose->codigo_plano == '3002' ? 'selected' : (old('codigo_plano') == '3002' ? 'selected' : '') }}>KLINI FÁCIL CA</option>
            <option value="3002" {{ $propose->codigo_plano == '3002' ? 'selected' : (old('codigo_plano') == '3002' ? 'selected' : '') }}>KLINI PRIME CA</option>
          </select>
        </div>
        <div class="col">
          <select name="codigo_plano" id="codigo_plano">
            <option>Plano Dental</option>
            <option value="7002" {{ $propose->codigo_plano == '7002' ? 'selected' : (old('codigo_plano') == '7002' ? 'selected' : '') }}>KLINI DENTAL FACIL CA</option>
            <option value="7003" {{ $propose->codigo_plano == '7003' ? 'selected' : (old('codigo_plano') == '7003' ? 'selected' : '') }}>KLINI DENTAL PRIME CA</option>
          </select>
        </div>
      </div>

      <input type="button" name="previous" class="previous action-button" value="Anterior" />
      <input type="submit" class="submit action-button" dust="SendForm" value="Atualizar" />
    </fieldset>
  </form>
</div>
@endsection
