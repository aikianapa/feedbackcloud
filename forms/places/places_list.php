<div class="element-content mt-2">
    <h5 class="element-header">
                     {{_lang.title}}
                     <button class="btn btn-sm btn-success pull-right" data-wb="role=ajax&url=/form/{{_form}}/edit/_new&append=#content">
                       <i class="fa fa-plus"></i> {{_lang.add}}
                     </button>
    </h5>
    <div class="element-box mt-3">
        <div class="table-responsive">
            <table class="table table-lightborder">
                <thead class="thead-dark">
                    <tr>
                        <th>{{_lang.header}}</th>
                        <th class="text-center"> {{_lang.visible}} </th>
                        <th class="text-right"> {{_lang.action}} </th>
                    </tr>
                </thead>
                <tbody data-api="{'url':'/query/places/','callback':'placesList'}" id="{{_form}}List">
                    <template class="wb-done">
                    {{#each result}}
                    <tr>
                        <td class="nowrap">
                          {{name}}
                        </td>
                        <td class="text-center">
                          <label class="switch">
                            <input type="checkbox" name="active" data-wb="role=save&form={{_form}}&item={{id}}&field=active">
                            <span></span>
                          </label>
                        </td>
                        <td class="text-right list-actions"  data-wb="role=include&form=places_actions"></td>
                    </tr>
                    {{/each}}
                  </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="/forms/places/places.js"></script>

<script type="text/locale">
[en]
title		= "Items list"
name            = "Item name"
header		= "Header"
visible		= "Visible"
invisible	= "Invisible"
action		= "action"
add             = "Add item"
[ru]
title		= "Список мест"
name            = "Имя записи"
header		= "Наименование"
visible		= "Отображать"
invisible	= "Не отображать"
action		= "Действие"
add             = "Добавить запись"
</script>
