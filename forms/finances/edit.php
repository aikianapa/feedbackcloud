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
                  aria-haspopup="true" aria-expanded="false">
                  <wb-data wb="{'table':'users','item':'{{company}}'}">
                  {{first_name}}
                  </wb-data>
                </button>
                <div class="dropdown-menu">

                  <div class="search-form">
                    <input type="hidden" name="company" />
                    <input type="search" class="form-control" placeholder="Плательщик" data-ajax="{'target':'#{{_form}}ModalEditOwners','filter_add':{'$or':[{ 'first_name' : {'$like' : '$value'} }, { 'name': {'$like' : '$value'} } ]} }"
                    />
                    <button class="btn" type="button"><i class="ri-search-line"></i></button>
                  </div>
                  <div id="{{_form}}ModalEditOwners">
                    <wb-foreach data-ajax="{'url':'/ajax/form/users/list/','size':'15','filter':{'role': 'chatown','active':'on'},'bind':'cms.edit.finown','render':'client'}"
                      auto>
                      <div class="p-1 cursor-pointer" data-id="{{_id}}" onclick="setDropdown(this)">
                        {{first_name}}
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
              <select class="form-control" name="tarif" wb-tree="{'table':'catalogs','item':'tarifs','field':'tree'}" onChange="setPrice(this)">
                <option value="{{data.id}}" data-month="{{data.month}}" data-price="{{data.price}}">
                  {{name}}
                </option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Сумма</label>
            <div class="col-sm-5">
              <input type="number" class="form-control" name="sum" placeholder="Сумма" readonly>
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
        <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary tx-13" wb-save="{'table':'{{_form}}','id':'{{_id}}','form':'#{{_form}}EditForm','update':'cms.list.{{_form}}' }">Сохранить</button>
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
    console.log($opt)
    $form.find("input[name=sum]").val($opt.attr('data-price'));
}
</script>

</html>
