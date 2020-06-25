<html>
<div class="modal fade effect-scale show removable" id="{{_form}}ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body pd-20">

        <form id="{{_form}}EditForm">
          <input type="hidden" name="id" />

          <div class="form-group row">
              <label class="col-sm-3 form-control-label">Плательщик</label>
              <div class="col-sm-9">

                <button class="form-control tx-left dropdown-toggle" type="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" wb-if='"{{company}}" > "" ==> disabled'>
                  <span wb-if='"{{company}}" == ""'>Выберите плательщика...</span>
                  <wb-data wb="{'table':'users','item':'{{company}}'}">
                  {{name}} <span wb-if='"{{inn}}" > ""'>ИНН: {{inn}}</span>
                  </wb-data>
                </button>
                <div class="dropdown-menu">

                  <div class="search-form">
                    <input type="hidden" name="company" />
                    <input type="search" class="form-control" placeholder="Плательщик" data-ajax="{'target':'#{{_form}}ModalEditOwners','filter_add':{'$or':[{ 'first_name' : {'$like' : '$value'} }, { 'name': {'$like' : '$value'} }, { 'inn': {'$like' : '$value'} } ]} }"
                    />
                    <button class="btn" type="button"><i class="ri-search-line"></i></button>
                  </div>
                  <div id="{{_form}}ModalEditOwners">
                    <wb-foreach data-ajax="{'url':'/ajax/form/users/list/','size':'15','filter':{'role': 'chatown','active':'on'},'bind':'cms.edit.finown','render':'client'}"
                      auto>
                      <div class="p-1 cursor-pointer" data-id="{{_id}}" onclick="setDropdown(this)">
                        {{name}}
                        [[#if inn]]
                        <small>ИНН: {{inn}}</small>
                        [[/if]]
                      </div>
                    </wb-foreach>
                  </div>

                </div>
              </div>
          </div>


          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Дата платежа</label>
            <div class="col-sm-5">
              <input wb-module="{'module':'datetimepicker','type':'datepicker'}" name="date" class="form-control" placeholder="Дата платежа">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Тариф</label>
            <div class="col-sm-5">
              <select class="form-control" name="tarif" wb-tree="{'table':'catalogs','item':'tarifs','field':'tree'}" onChange="setPrice(this)" placeholder="Выберите тариф...">
                <option value="{{id}}" data-month="{{data.month}}" data-price="{{data.price}}">
                  {{name}}
                </option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Сумма</label>
            <div class="input-group col-sm-5">
              <input type="number" class="form-control text-right" name="sum" placeholder="Сумма">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-rub"></i></span>
              </div>
            </div>

            <div class="input-group col-sm-4">
              <input type="text" name="month" class="form-control text-right" placeholder="Тариф" readonly>
              <div class="input-group-append">
                <span class="input-group-text">месяц(ев)</span>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Наименование платежа</label>
            <div class="col-sm-9">
              <textarea name="name" rows="auto" class="form-control" placeholder="Наименование платежа"></textarea>
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
<script>
var setDropdown = function(ev) {
    var btn = $(ev).parents(".dropdown-menu").prev(".dropdown-toggle");
    var inp = $(ev).parents(".dropdown-menu").find("input[type=hidden]");
    $(inp).val($(ev).data("id"));
    $(btn).text($(ev).text());
}
var setPrice = function(ev) {
    let $opt = $(ev).find("option:selected",0);
    let $form = $(ev).parents("form");
    $form.find("input[name=sum]").val($opt.attr('data-price'));
    $form.find("input[name=month]").val($opt.attr('data-month'));
}

$("#{{_form}}ModalEdit").off("wb-save-done");
$("#{{_form}}ModalEdit").on("wb-save-done",function(ev,result){
  if (result.data.company !== undefined && result.data.company > "") {
      $("#{{_form}}ModalEdit button.dropdown-toggle").prop("disabled",true);
  }
})
</script>

</html>
