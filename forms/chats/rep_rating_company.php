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
          <td class="text-center">
            {{rating_start}}
          </td>
          <td class="text-center">
            {{rating_finish}}
          </td>
        </tr>
    </wb-foreach>
  </tbody>
</table>

</html>
