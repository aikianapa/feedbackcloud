<html>
<div class="modal fade effect-scale show removable" id="{{_form}}ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="fa fa-close wd-20" data-dismiss="modal" aria-label="Close"></i>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}SwitchItemActive"
            onchange="$('#{{_form}}ValueItemActive').prop('checked',$(this).prop('checked'));">
          <label class="custom-control-label" for="{{_form}}SwitchItemActive">Активирован</label>
        </div>
      </div>
      <div class="modal-body pd-20">

        <form id="{{_form}}EditForm">
          <input type="checkbox" class="custom-control-input" name="active" id="{{_form}}ValueItemActive">


          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="#{{_form}}EditFormMain" data-toggle="tab" class="nav-link active">Основные</a>
            </li>
            <li class="nav-item">
              <a href="#{{_form}}EditFormTables" data-toggle="tab" class="nav-link">Столы</a>
            </li>
            <li class="nav-item">
              <a href="#{{_form}}EditFormSettings" data-toggle="tab" class="nav-link">Настройки</a>
            </li>
          </ul>

          <div class="tab-content bd bd-gray-300 bd-t-0 pd-20">
            <div id="{{_form}}EditFormMain" class="tab-pane fade show active" role="tabpanel">

              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Наименование</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" placeholder="Наименование места">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 form-control-label">Адрес</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="address" placeholder="Адрес">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-12 form-control-label">Текст</label>
                <div class="col-12">
                  <wb-module wb="{'module':'jodit'}" name="text" />
                </div>
              </div>

            </div>
            <div id="{{_form}}EditFormTables" class="tab-pane fade" role="tabpanel">
              Столы
              {{tables}}
              <wb-multiinput name="tables">
                <div class="col-1"><input type="checkbox" name="active" class="form-control tx-12"/></div>
                <div class="col-2"><input type="number" name="table" class="form-control"/></div>
                <div class="col"><input type="text" name="name" class="form-control"/></div>
              </wb-multiinput>
            </div>
            <div id="{{_form}}EditFormSettings" class="tab-pane fade" role="tabpanel">
              Настройки
            </div>
          </div>



        </form>

      </div>
      <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
          <wb-include wb="{'form':'common_formsave.php'}" />
      </div>
    </div>
  </div>
</div>

</html>
