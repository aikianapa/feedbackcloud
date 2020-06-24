<html>
<div class="modal fade effect-scale show removable" id="{{_form}}ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}SwitchItemActive"
            onchange="$('#{{_form}}ValueItemActive').prop('checked',$(this).prop('checked'));">
          <label class="custom-control-label" for="{{_form}}SwitchItemActive">Активирован</label>
        </div>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body pd-20">

        <form id="{{_form}}EditForm" autocomplete="off">
          <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}ValueItemActive">
          <div class="form-group row">
          <div class="input-group col-12">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ri-user-line"></i></span>
            </div>
            <input type="text" name="_id" class="form-control" readonly placeholder="Идентификатор">
            <div class="input-group-append d-sm-flex d-none">
              <span class="input-group-text"><i class="ri-group-line"></i></span>
            </div>
            <div class="input-group-append">
              <select class="btn btn-outline-light" name="role">
                <wb-foreach wb="{'table':'users','filter':{'isgroup': 'on'}}">
                <option class="dropdown-item" value="{{_id}}">{{name}}</option>
                </wb-foreach>
              </select>
            </div>
          </div>
          </div>

          <div class="form-group row">
            <div class="input-group col-12">
              <div class="input-group-prepend">
                <span class="input-group-text">Компания</span>
              </div>
              <input type="text" name="name" class="form-control" placeholder="Наименование компании">
            </div>
          </div>

          <div class="form-group row">
            <div class="input-group col-sm-6 col-12">
              <div class="input-group-prepend">
                <span class="input-group-text">Имя</span>
              </div>
              <input type="text" name="first_name" class="form-control" placeholder="Имя">
            </div>
            <p class="d-block d-sm-none p-1" />
            <div class="input-group col-sm-6 col-12">
              <div class="input-group-prepend">
                <span class="input-group-text">Фамилия</span>
              </div>
              <input type="text" name="last_name" class="form-control" placeholder="Фамилия">
            </div>
          </div>

          <div class="form-group row">
            <div class="input-group col-sm-6 col-12">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ri-mail-line"></i></span>
              </div>
              <input type="text" name="email" class="form-control" placeholder="Электронная почта">
            </div>
            <p class="d-block d-sm-none p-1" />
            <div class="input-group col-sm-6 col-12">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ri-phone-line"></i></span>
              </div>
              <input type="text" name="phone" class="form-control" placeholder="Телефон">
            </div>
          </div>

          <div class="form-group row">
            <div class="input-group col-sm-6 col-12">
              <div class="input-group-prepend">
                <span class="input-group-text">ИНН</span>
              </div>
              <input type="text" name="inn" class="form-control" placeholder="ИНН">
            </div>
            <p class="d-block d-sm-none p-1" />
            <div class="input-group col-sm-6 col-12">
              <div class="input-group-prepend">
                <span class="input-group-text">ОГРН</span>
              </div>
              <input type="text" name="ogrn" class="form-control" placeholder="ОГРН">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-12">
              <wb-module wb="{'module':'jodit'}" name="text"/>
            </div>
          </div>


        </form>

      </div>
      <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
        <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary tx-13" wb-save="{'table':'{{_table}}','id':'{{_id}}','form':'#{{_form}}EditForm','update':'cms.list.{{_form}}' }">Сохранить</button>
      </div>
    </div>
  </div>
</div>
</html>
