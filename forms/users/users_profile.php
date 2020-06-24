<div class="element-content mt-2">
  <h5 class="element-header">
           Ваш профиль
           <button class="btn btn-sm btn-success pull-right" data-wb="role=save&form=users&item={{_env.user.id}}&selector=#usersEditForm">
             <i class="fa fa-save"></i> Сохранить
           </button>
    </h5>
  <div class="element-box mt-3">
    <form id="usersEditForm" class="form-horizontal" role="form" data-wb-allow="chatown"
      data-wb="role=formdata&form=users&item={{_env.user.id}}">
      <div data-wb="role=include&form=common_changePassword&hide=true"></div>
      <div class="form-group row">
        <div class="col-sm-6">
          <label class="form-control-label">Имя</label>
          <input type="text" class="form-control" name="first_name" placeholder="Имя">
        </div>
        <div class="col-sm-6">
          <label class="form-control-label">Фамилия</label>
          <input type="text" class="form-control" name="last_name" placeholder="Фамилия">
        </div>
        <div class="col-sm-6">
          <label class="form-control-label">Телефон</label>
          <input type="phone" data-mask="+7 (999) 999 99 99" class="form-control" name="phone"
            placeholder="Телефон">
        </div>
        <div class="col-sm-6">
          <label class="form-control-label">Эл.почта</label>
          <input type="text" class="form-control" name="email" placeholder="Эл.почта">
        </div>

      </div>

      <div class="form-group row">
        <div class="col-sm-4">
          <label class="form-control-label">Аватар</label>
          <input data-wb="role=module&load=filepicker&mode=single&path=/uploads/users/{{id}}/"
            name="avatar">
        </div>
        <div class="col-sm-8">
          <label class="form-control-label">О себе</label>
          <meta placeholder="{{_LANG[about]}}" name="text" data-wb="role=include&snippet=editor">
        </div>
      </div>

    </form>
  </div>
</div>
