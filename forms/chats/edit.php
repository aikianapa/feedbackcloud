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



            <div id="{{_form}}EditFormMain" class="tab-pane fade show active" role="tabpanel">

              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Дата начала</label>
                <div class="col-sm-9">
                  <input type="text" name="show.date" class="form-control" placeholder="Дата начала" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Наименование</label>
                <div class="col-sm-9">
                  <input type="text" name="show.place" class="form-control" placeholder="Наименование места" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Адрес</label>
                <div class="col-sm-9">
                  <wb-data wb="table=places&item={{place}}">
                    <input type="text" class="form-control" name="address" placeholder="Адрес" readonly>
                  </wb-data>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Рейтинг начальный</label>
                <div class="col-sm-3">
                    <input type="number" min="1" class="form-control" name="initial_rating" placeholder="Рейтинг начальный">
                </div>
                <label class="col-sm-3 form-control-label">Рейтинг финальный</label>
                <div class="col-sm-3">
                    <input type="number" min="1" class="form-control" name="rating" placeholder="Рейтинг финальный">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-12 form-control-label">Сообщения</label>
                <div class="col-12">
                  <ul class="list-group m-2">
                  <wb-foreach wb="{'from':'msg'}">
                    <wb-var gray=""/>
                    <wb-var gray="bg-gray-100 text-right" wb-if='"{{reply}}" > ""'/>
                    <wb-var user="Клиент"/>
                    <wb-var user="Менеджер" wb-if='"{{reply}}" > ""'/>
                    <li class="list-group-item {{_var.gray}}">
                        <small class="pb-2">
                          <i class="ri-user-line"></i> {{_var.user}}
                          <i class="ri-calendar-line"></i> {{date("d.m.Y H:i:s",strtotime({{date}}))}}
                        </small>
                        <div wb-if='"{{reply}}" > ""'>
                            {{reply}}
                        </div>
                        <div wb-if='"{{text}}" > ""'>
                            {{text}}
                        </div>
                    </li>
                  </wb-foreach>
                  </ul>
                </div>
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
