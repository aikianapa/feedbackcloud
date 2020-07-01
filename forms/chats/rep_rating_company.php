<html>
<h4>Компании по рейтингу</h4>
<table class="table table-striped table-hover table-sm table-reflow table-bordered tx-14">
  <thead>
    <tr>
      <th>#</th>
      <th>Наименование</th>
      <th>Контакты</th>
      <th>Рейтинг<br>начальный</th>
      <th>Рейтинг<br>конечный</th>
    </tr>
  </thead>
  <tbody>
      <wb-var star='<i class="fa fa-star"></i>' />
    <wb-foreach wb='{
        "table" : "users",
        "size": "50",
        "sort"  : "rating_finish:d",
        "filter": {"role":"chatown","active":"on" },
        "html"  : "#financesList"
      }'>
        <tr>
          <th scope="row">{{_ndx}}</th>
          <td>{{name}}<br><small>{{inn}}</small></td>
          <td>{{phone}}<br wb-if='"{{email}}">""'>{{email}}
          </td>
          <td class="text-center text-secondary">
            {{str_repeat({{_var.star}},{{rating_start}})}}
          </td>
          <wb-var color="text-secondary" wb-if='"{{rating_start}}" == "{{rating_finish}}"' />
          <wb-var color="text-danger" wb-if='"{{rating_start}}" > "{{rating_finish}}"' />
          <wb-var color="text-success" wb-if='"{{rating_start}}" < "{{rating_finish}}"' />

          <td class="text-center {{_var.color}}">
            {{str_repeat({{_var.star}},{{rating_finish}})}}
          </td>
        </tr>
    </wb-foreach>
  </tbody>
</table>

</html>
