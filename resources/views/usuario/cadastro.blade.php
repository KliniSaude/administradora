<?php $title = "Cadastrado do Usuário - Klini Saúde" ?>
<?php include_once('../template/header.php'); ?>

<div class="container vh-100">
  <form action="" class="row justify-content-center g-3">
    <div class="col-4">
      <div class="col-12 mb-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <img src="../../assets/img/logos/perfil-female.png" style="width: 210px;">
        </div>
      </div>
      <div class="col-12 mb-4">
        <input type="text" name="nome_usuario" class="form-control" id="nome_usuario" placeholder="Nome" value="">
      </div>
      <div class="col-12 mb-4">
        <input type="text" name="nome_administradora" class="form-control" id="nome_administradora" placeholder="Administradora" value="">
      </div>
      <div class="col-12 mb-4">
        <input type="email" name="email_administradora" class="form-control" id="email_administradora" placeholder="E-mail" value="">
      </div>
      <div class="col-12 mb-4">
        <input type="file" name="profile_image" class="form-control" id="profile_image" accept="image/png, image/gif, image/jpeg">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-klini-primary text-light">Atualizar</button>
      </div>
    </div>
  </form>
</div>

<?php include_once('../template/footer.php'); ?>
