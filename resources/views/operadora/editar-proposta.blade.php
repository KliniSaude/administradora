@extends('layout.main')
@section('content')
<!-- multistep form -->
<div class="container ">
  <form method="POST" action="{{ route('operadora.ok.proposta', ['id' => $propose->id]) }}">
    @csrf
    @method('PUT')

    <div class="row mb-5 border p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-file-contract"></i> Dados da Operação</h3>
      <div class="col-md-4">
        <label class="form-label">Tipo de Operação</label>
        <select class="form-select" disabled>
          <option value="">Tipo de Operação</option>
            <option value="1" {{ $propose->codigo_tipo_operacao == '1' ? 'selected' : (old('codigo_tipo_operacao') == '1' ? 'selected' : '') }}>INCLUSÃO</option>
            <option value="2" {{ $propose->codigo_tipo_operacao == '2' ? 'selected' : (old('codigo_tipo_operacao') == '2' ? 'selected' : '') }}>EXCLUSÃO</option>
            <option value="3" {{ $propose->codigo_tipo_operacao == '3' ? 'selected' : (old('codigo_tipo_operacao') == '3' ? 'selected' : '') }}>SUSPENSÃO</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Contrato</label>
        <select class="form-select" disabled>
          <option value="">Contrato</option>
          @foreach ($entities as $entity)
          <option value="{{ $entity->contrato }}" {{ $propose->fk_contrato == $entity->contrato ? 'selected' : (old('fk_contrato') == $entity->contrato ? 'selected' : '') }} data-vigencia="{{ $entity->data }}" >{{ $entity->contrato }} - {{ $entity->nome_entidade }}</option>
          @endforeach
        </select>
      </div>
      @if ($propose->numero_associado_titular)
      <div class="col-md-4 mb-2">
        <label class="form-label">Número Associado</label>
        <input type="text" class="form-control" value="{{ $propose->numero_associado_titular }}" readonly>
      </div>
      @endif
      @if ($propose->codigo_motivo_exclusao)
      <div class="col-md-4 mb-2">
        <label class="form-label">Motivo da Exclusão</label>
        <select class="form-select" disabled>
          <option>Motivo da Exclusão</option>
          <option value="1" {{ $propose->codigo_motivo_exclusao == '1' ? 'selected' : (old('codigo_motivo_exclusao') == '1' ? 'selected' : '') }}>A pedido do beneficiário</option>
          <option value="2" {{ $propose->codigo_motivo_exclusao == '2' ? 'selected' : (old('codigo_motivo_exclusao') == '2' ? 'selected' : '') }}>Fim da depenpendência a um Titular</option>
          <option value="4" {{ $propose->codigo_motivo_exclusao == '4' ? 'selected' : (old('codigo_motivo_exclusao') == '4' ? 'selected' : '') }}>Exclusão por inadimplência</option>
          <option value="5" {{ $propose->codigo_motivo_exclusao == '5' ? 'selected' : (old('codigo_motivo_exclusao') == '5' ? 'selected' : '') }}>Falecimento</option>
          <option value="11" {{ $propose->codigo_motivo_exclusao == '11' ? 'selected' : (old('codigo_motivo_exclusao') == '11' ? 'selected' : '') }}>Exclusão por Portabilidade</option>
          <option value="50" {{ $propose->codigo_motivo_exclusao == '50' ? 'selected' : (old('codigo_motivo_exclusao') == '50' ? 'selected' : '') }}>Motivo financeiro</option>
        </select>
      </div>
      @endif
      @if ($propose->data_inclusao)
      <div class="col-md-4 mb-2">
        <label class="form-label">Data Inclusão</label>
        <input type="text" class="form-control" value="{{ $propose->data_inclusao }}" readonly>
      </div>
      @endif
      @if ($propose->data_exclusao)
      <div class="col-md-4 mb-2">
        <label class="form-label">Data Exclusão</label>
        <input type="text" class="form-control" value="{{ $propose->data_exclusao }}" readonly>
      </div>
      @endif
    </div>

    <div class="row mb-5 border p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-file-contract"></i> <i class="fas fa-user-alt"></i> Dados do Associado</h3>
      <div class="col-md-6 mb-2">
        <label class="form-label">Nome Associado</label>
        <input type="text" class="form-control" value="{{ $propose->nome_associado }}" readonly>
      </div>
      <div class="col-md-4 mb-2">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control" value="{{ $propose->cpf }}" readonly>
      </div>
      <div class="col-md-2 mb-2">
        <label class="form-label">Sexo</label>
        <select name="sexo" id="sexo" class="form-select" disabled>
          <option>Sexo</option>
          <option value="M" {{ $propose->sexo == 'M' ? 'selected' : (old('sexo') == 'M' ? 'selected' : '') }}>Masculino</option>
          <option value="F" {{ $propose->sexo == 'F' ? 'selected' : (old('sexo') == 'F' ? 'selected' : '') }}>Feminino</option>
        </select>
      </div>
      <div class="col-md-2 mb-2">
        <label class="form-label">Estado Civil</label>
        <select name="estado_civil" id="estado_civil" class="form-select" disabled>
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
      <div class="col-md-6 mb-2">
        <label class="form-label">Nome da Mãe</label>
        <input type="text" class="form-control" value="{{ $propose->filiacao }}" readonly>
      </div>
      <div class="col-md-2 mb-2">
        <label class="form-label">Nascimento</label>
        <input type="text" class="form-control" value="{{ $propose->nascimento }}" readonly>
      </div>
      <div class="col-md-2 mb-2">
        <label class="form-label">Número Unico Saúde</label>
        <input type="text" class="form-control" value="{{ $propose->numero_unico_saude }}" readonly>
      </div>
      <div class="col-md-2 mb-2">
        <label class="form-label">Número DN</label>
        <input type="text" class="form-control" value="{{ $propose->numero_dn }}" readonly>
      </div>
      <div class="col-md-2 mb-2">
        <label class="form-label">Grupo Carencia</label>
        <select name="codigo_grupo_carencia" id="codigo_grupo_carencia" class="form-select" disabled>
          <option>Grupo Carencia</option>
          <option value="6601" {{ $propose->codigo_grupo_carencia == '6601' ? 'selected' : (old('codigo_grupo_carencia') == '6601' ? 'selected' : '') }}>CARENCIA CA 1</option>
          <option value="6602" {{ $propose->codigo_grupo_carencia == '6602' ? 'selected' : (old('codigo_grupo_carencia') == '6602' ? 'selected' : '') }}>CARENCIA CA 2</option>
          <option value="6603" {{ $propose->codigo_grupo_carencia == '6603' ? 'selected' : (old('codigo_grupo_carencia') == '6603' ? 'selected' : '') }}>CARENCIA CA 3</option>
        </select>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Grupo Carência Odonto</label>
        <select name="codigoGrupoCarenciaOdonto" id="codigo_grupo_carencia_odonto" class="form-select" disabled>
          <option>Grupo Carência Odonto</option>
          <option value="8801" {{ $propose->codigoGrupoCarenciaOdonto == '8801' ? 'selected' : (old('codigoGrupoCarenciaOdonto') == '8801' ? 'selected' : '') }}>ODONTOLOGICO CPA1</option>
        </select>
      </div>
    </div>

    @if (isset($dependents))
    <div class="row mb-5 border p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-users"></i> Dados dos Dependentes</h3>
      @foreach ($dependents as $dependent)
      <div class="row mb-3 p-3">
        <div class="col-md-2 mb-2">
          <label class="form-label">Tipo Dependencia</label>
          <select name="codigo_dependencia[]" id="codigo_dependencia" class="form-select" disabled>
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
        </div>
        <div class="col-md-6 mb-2">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" value="{{ $dependent->nome_dependente }}" readonly>
        </div>
        <div class="col-md-4 mb-2">
          <label class="form-label">CPF</label>
          <input type="text" class="form-control" value="{{ $dependent->cpf_dependente }}" readonly>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Sexo</label>
          <select name="sexo_dependente[]" id="sexo_dependente" class="form-select" disabled>
            <option>Sexo</option>
            <option value="M" {{ $dependent->sexo_dependente == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ $dependent->sexo_dependente == 'F' ? 'selected' : '' }}>Feminino</option>
          </select>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Estado Civil</label>
          <select name="estado_civil_dependente[]" id="estado_civil_dependente" class="form-select" disabled>
            <option>Estado Civil</option>
            <option value="1" {{ $dependent->estado_civil_dependente == '1' ? 'selected' : '' }}>Solteiro</option>
            <option value="2" {{ $dependent->estado_civil_dependente == '2' ? 'selected' : '' }}>Casado</option>
            <option value="4" {{ $dependent->estado_civil_dependente == '4' ? 'selected' : '' }}>Separado</option>
            <option value="5" {{ $dependent->estado_civil_dependente == '5' ? 'selected' : '' }}>Divorciado</option>
            <option value="7" {{ $dependent->estado_civil_dependente == '7' ? 'selected' : '' }}>Viúvo(a)</option>
            <option value="8" {{ $dependent->estado_civil_dependente == '8' ? 'selected' : '' }}>Companheiro(a)</option>
            <option value="6" {{ $dependent->estado_civil_dependente == '6' ? 'selected' : '' }}>Outros</option>
          </select>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Nascimento</label>
          <input type="text" class="form-control" value="{{ $dependent->nascimento_dependente }}" readonly>
        </div>
        <div class="col-md-6 mb-2">
          <label class="form-label">Filiação</label>
          <input type="text" class="form-control" value="{{ $dependent->filiacao_dependente }}" readonly>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Número Unico Saúde</label>
          <input type="text" class="form-control" value="{{ $dependent->numero_unico_saude_dependente }}" readonly>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Número DN</label>
          <input type="text" class="form-control" value="{{ $dependent->numero_dn_dependente }}" readonly>
        </div>
        <div class="col-md-2 mb-2">
          <label class="form-label">Grupo Carencia</label>
          <input type="text" class="form-control" value="{{ $dependent->codigo_grupo_carencia_dependente }}" readonly>
        </div>
        <div class="col-md-3 mb-2">
          <label class="form-label">Grupo Carência Odonto</label>
          <input type="text" class="form-control" value="{{ $dependent->codigo_grupo_carencia_odonto_dependente }}" readonly>
        </div>
      </div>
      <hr>
      @endforeach
    </div>
    @endif

    <div class="row mb-5 border p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-map-marker-alt"></i> Endereço</h3>
      <div class="col-md-3 mb-2">
        <label class="form-label">CEP</label>
        <input type="text" class="form-control" value="{{ $propose->cep }}" readonly>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Logradouro</label>
        <input type="text" class="form-control" value="{{ $propose->logradouro }}" readonly>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Número</label>
        <input type="text" class="form-control" value="{{ $propose->numero }}" readonly>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Complemento</label>
        <input type="text" class="form-control" value="{{ $propose->complemento }}" readonly>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Bairro</label>
        <input type="text" class="form-control" value="{{ $propose->bairro }}" readonly>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control" value="{{ $propose->cidade }}" readonly>
      </div>
      <div class="col-md-3 mb-2">
        <label class="form-label">Estado</label>
        <input type="text" class="form-control" value="{{ $propose->estado }}" readonly>
      </div>
    </div>

    <div class="row mb-5 border p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-envelope"></i> Dados de Contato</h3>
      <div class="col-md-4 mb-2">
        <label class="form-label">E-mail</label>
        <input type="text" class="form-control" value="{{ $propose->email }}" readonly>
      </div>
      <div class="col-md-4 mb-2">
        <label class="form-label">DDD</label>
        <input type="text" class="form-control" value="{{ $propose->ddd }}" readonly>
      </div>
      <div class="col-md-4 mb-2">
        <label class="form-label">Telefone</label>
        <input type="text" class="form-control" value="{{ $propose->telefone }}" readonly>
      </div>
    </div>

    <div class="row border p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-heartbeat"></i> Dados do Plano</h3>
      <div class="col-md-4 mb-2">
        <label class="form-label">Código Empresa</label>
        <input type="text" class="form-control" value="{{ $propose->codigo_empresa }}" readonly>
      </div>
      <div class="col-md-4 mb-2">
        <label class="form-label">Plano Saúde</label>
        <select name="codigo_plano" id="codigo_plano" class="form-select" disabled>
          <option>Plano Saúde</option>
          <option value="3002" {{ $propose->codigo_plano == '3002' ? 'selected' : (old('codigo_plano') == '3002' ? 'selected' : '') }}>KLINI FÁCIL CA</option>
          <option value="3002" {{ $propose->codigo_plano == '3002' ? 'selected' : (old('codigo_plano') == '3002' ? 'selected' : '') }}>KLINI PRIME CA</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Plano Dental</label>
        <select name="codigo_plano" id="codigo_plano" class="form-select" disabled>
          <option>Plano Dental</option>
          <option value="7002" {{ $propose->codigo_plano == '7002' ? 'selected' : (old('codigo_plano') == '7002' ? 'selected' : '') }}>KLINI DENTAL FACIL CA</option>
          <option value="7003" {{ $propose->codigo_plano == '7003' ? 'selected' : (old('codigo_plano') == '7003' ? 'selected' : '') }}>KLINI DENTAL PRIME CA</option>
        </select>
      </div>
    </div>

    <div class="row mb-5">
      <button class="btn btn-primary bg-primary text-white" type="submit"><i class="fas fa-check"></i> Tudo certo!</button>
    </div>
  </form>

  <form action="{{ route('operadora.correct.proposta', ['id' => $propose->id]) }}" method="post" class="my-2">
    @csrf
    {{ method_field('PUT') }}
    <div class="row border border-info border-4 p-3">
      <h3 class="fs-6 text-secondary"><i class="fas fa-check-double"></i> Correções a serem feitas</h3>
      <div class="col-md-12 mb-2">
        <label class="form-label">Informe os campos que devem ser corrigidos</label>
        <textarea class="form-control" name="mensagem" placeholder="Ex.: Campo Nome Titulo: Nome incompleto, Campo CPF Titular: Cpf não encontrado na base">Existe campos a serem corrigidos</textarea>
      </div>
    </div>
    <div class="row">
      <button type="submit" class="btn btn-primary bg-warning text-white"><i class="fas fa-times"></i> Corrigir</button>
    </div>
  </form>
</div>
@endsection
