<html>
<h4>Компании на подписке</h4>
<table class="table table-striped table-hover table-sm table-reflow table-bordered tx-14">
  <thead>
    <tr>
      <th>#</th>
      <th>Наименование</th>
      <th>Контакты</th>
      <th>Срок до</th>
    </tr>
  </thead>
  <tbody>
    <wb-foreach wb='{
        "table" : "users",
        "sort"  : "_created",
        "filter": {"role":"chatown","active":"on", "expired" : {"$gte":"{{date()}}"} },
        "html"  : "#financesList"
      }'>
        <tr>
          <th scope="row">{{_ndx}}</th>
          <td>{{name}}<br><small>{{inn}}</small></td>
          <td>{{phone}}<br>{{email}}</td>
          <td>{{date("d.m.Y",strtotime({{expired}}))}}<br>
            <small>осталось дней:
               {{ intval((strtotime({{expired}}) -  time()) / (3600*24))  }}
             </small>
          </td>
        </tr>
    </wb-foreach>
  </tbody>
</table>

</html>
