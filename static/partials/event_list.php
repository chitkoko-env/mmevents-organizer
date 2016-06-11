<div class="container-fluid card" ng-controller="event_list">

   <title>Event List</title>
   <div class="header row">
      <i class="fa fa-map-marker"></i> Event List
      <div class="col-md-5 pull-right">
        <div class="visible-xs visible-sm"><br></div>
        <div class="input-group">
          <span class="input-group-btn">
              <a class="btn btn-default" ng-click="openeventdialog()">
              <i class="fa fa-plus" style="color:#337AB7"></i> Add Event</a>   
          </span>
          <input type="text" class="form-control" ng-model="search.$" placeholder="Search..." x-ng-focus="true" ng-keyup="finddata(search)">
          <span class="input-group-addon"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredEvent.length}} | Total : {{eventlst.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="searchObjResults">
        <thead>
          <tr>
            <th>Title</th>
            <th>City</th>   
            <th>Township</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Venue</th>    
          </tr>
        </thead>
        <tbody>   
          <tr ng-repeat="c in filteredEvent | filter:search:strict" style="cursor:pointer;" ng-click="goDetail(c.event_id)">
            <td>{{c.title}}</td>
            <td>{{c.city_name}}</td>
            <td>{{c.township_name}}</td>
            <td>{{c.category_name}}</td>
            <td>{{c.sub_category_name}}</td>
            <td>{{c.v_name}}</td>
          </tr> 
        </tbody>  
      </table>
    </div>

    <div ng-show="pagi" style="" class="row" align="right">
        <label class="pull-right" style="padding:25px;">
          Count: {{filteredEvent.length}} | Total : {{eventlst.length}}
        </label>
        <div class="pull-right">
           <pagination boundary-links="true" total-items="totalitems" ng-model="currentPage" max-size="maxSize"
             ng-change="pageChanged()" class="pagination" 
             previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;">
          </pagination>   
        </div>    
    </div>

   <?php include('./event_dialog_tpl.php');?>

</div>