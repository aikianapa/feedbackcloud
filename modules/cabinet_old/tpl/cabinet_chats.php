<div class="element-content mt-2" data-wb-allow="chatown">
  <h5 class="element-header row">Чаты</h5>
  <div id="chatsList-top" class="sr-only" style="top:-50px;"></div>
  <div class="element-box row" >


    <div class="col-sm-3">
      <label class="content-left-label">Места</label>
      <div class="list-group" id="chatsCatalog" data-wb="role=foreach&form=places" data-wb-if='_creator="{{_env.user.id}}" AND active="on"'>
        <a href="#chatsList-top" title="{{name}}"
          data-wb-html="#content" data-watcher="filter=#chatsList" data-filter='{"place":"{{id}}"}'
          class="list-group-item list-group-item-action">
          {{header}}
        </a>
      </div>
    </div>


    <div class="col-sm-9">

      <div class="table-responsive">
        <table class="table table-lightborder table-hover table-striped">
          <thead class="thead-dark">
            <tr data-wb-where='"{{_route.params.groups}}"!="true"'>
              <th>Идентификатор</th>
              <th class="d-none d-sm-table-cell">Дата</th>
              <th class="d-none d-sm-table-cell">Место</th>
              <th class="text-center">Статус</th>
              <th class="text-right">Действие</th>
            </tr>
          </thead>
          <tbody data-wb="role=foreach&form=chat&size={{_sett.page_size}}&sort=_created:d"  data-wb-if='owner = "{{_env.user.id}}"' id="chatsList"  data-wb-if='active="on"'>
            <tr data-watcher="item={{id}}&watcher=#chatsList">
              <td class="nowrap w-20">{{id}}</td>
              <td class="d-none d-sm-table-cell w-auto">{{date("d.m.Y",strtotime(_created))}}<br><small>{{date("H:i:s",strtotime(_created)) }}</small></td>
              <td class="d-none d-sm-table-cell w-auto" data-wb="role=formdata&form=places&item={{place}}">{{header}}</td>
              <td class="text-center w-20">
                  <!--label class="switch"><input type="checkbox" name="active" data-wb="role=save&form={{_form}}&item={{id}}&field=active"><span></span></label-->
                  <i class="fa fa-circle text-success" data-wb-where='active="on"'></i>
                  <i class="fa fa-circle text-secondary" data-wb-where='active!="on"'></i>
              </td>
              <td class="text-right w-auto" data-wb="role=include&form=chat_actions"></td>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
