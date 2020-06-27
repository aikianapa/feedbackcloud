<html>
<h4>Компании по рейтингу</h4>
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
        "table" : "chats",
        "call": "_rep_rating_company",
        "size": "10",
        "return": "_id, _created",
        "sort"  : "_created",
        "____filter": {"role":"chatown","active":"on", "expired" : {"$gte":"{{date()}}"} },
        "html"  : "#financesList"
      }'>
        <tr>
          <th scope="row">{{_ndx}}</th>
          <td>{{name}}<br><small>{{inn}}</small></td>
          <td>{{phone}}<br>{{email}}

{{_id}} {{_created}}
          </td>
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
