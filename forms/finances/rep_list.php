<html>
<div class="chat-wrapper chat-wrapper-two">

  <div class="chat-sidebar">
    <div class="chat-sidebar-body" style="top:0;bottom:0;">
      <div class="flex-fill pd-y-20 pd-x-10">



        <div class="d-flex align-items-center justify-content-between pd-x-10 mg-b-10">
          <span class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1"><i class="ri-coin-line tx-14"></i> Отчёты</span>
        </div>
        <nav id="{{_form}}ListOwners" class="nav flex-column mg-b-20">
            <span class="nav-item active">
            <a class="nav-link" href="#" data-ajax="{'url':'/cms/ajax/form/finances/rep_trial/','html':'#{{_form}}List'}" auto>
              Компании на демо периоде
            </a>
          </span>
          <span class="nav-item">
          <a class="nav-link" href="#" data-ajax="{'url':'/ajax/form/finances/list/','size':'15','filter':{ 'company': '{{_id}}' },'bind':'cms.list.finances','target':'#{{_form}}List','render':'client'}">
            Компании на подписке
          </a>
        </span>
        <span class="nav-item">
        <a class="nav-link" href="#" data-ajax="{'url':'/ajax/form/finances/list/','size':'15','filter':{ 'company': '{{_id}}' },'bind':'cms.list.finances','target':'#{{_form}}List','render':'client'}">
          Истекающие в течении недели
        </a>
      </span>

        </nav>
      </div>
    </div>
  </div>

  <div class="chat-content">


    <div class="m-2" id="{{_form}}List">

    </div>
  </div>

</div>
<div class="financesedit-modal"></div>

</html>
