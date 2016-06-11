<!-- Event Dialog -->
    <script type="text/ng-template" id="eventdialog">
        <div class="modal-header">
            <a class="close" ng-click="closedialog()" data-dismiss="modal">&times;</a>
            <h3  class="modal-title"><i class="fa fa-map-marker"></i>&nbsp;{{title}}</h3>
        </div>
        <div class="modal-body">
            <form name="dataForm" class="form-horizontal backwell">       
               <fieldset>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.etitle.$invalid}">
                      <label class="control-label col-md-5" for="etitle">Title:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="etitle" ng-focus="true" ng-model="eventtitle" ng-keyup="formenter($event)" required/>                        
                      </div>
                  </div>
                  
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.cityname.$invalid}">
                      <label class="control-label col-md-5" for="cityname">City:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="cityname" ng-model="selcity" ng-options="c.city_name for c in citylst" ng-change="clickcity(selcity)"></select>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.townshipname.$invalid}">
                      <label class="control-label col-md-5" for="townshipname">Township:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="townshipname" ng-model="seltownship" ng-options="t.township_name for t in townshiplst" required></select>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.catename.$invalid}">
                      <label class="control-label col-md-5" for="catename">Category:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="catename" ng-model="selcate" ng-options="cat.category_name for cat in catelst" ng-change="clickcate(selcate)"></select>
                      </div>
                  </div>

                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.subcatename.$invalid}">
                      <label class="control-label col-md-5" for="subcatename">Sub Categories:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="subcatename" ng-model="selsubcate" ng-options="scate.sub_category_name for scate in subcatelst" required></select>
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.venuename.$invalid}">
                      <label class="control-label col-md-5" for="venuename">Venue:</label>
                      <div class="controls col-md-5">
                        <select class="form-control" name="venuename" ng-model="selvenue" ng-options="v.v_name for v in venuelst"></select>
                      </div>
                  </div>
                  
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.email.$invalid}">
                      <label class="control-label col-md-5" for="email">Email:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="email" ng-model="email" ng-keyup="formenter($event)" />                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.phone.$invalid}">
                      <label class="control-label col-md-5" for="phone">Phone:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="phone" ng-model="phone" ng-keyup="formenter($event)" />                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.fax.$invalid}">
                      <label class="control-label col-md-5" for="fax">Fax:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="fax" ng-model="fax" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.fblink.$invalid}">
                      <label class="control-label col-md-5" for="fblink">FB link:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="fblink" ng-model="fblink" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12" ng-class="{'has-error': dataForm.weblink.$invalid}">
                      <label class="control-label col-md-5" for="weblink">Website:</label>
                      <div class="controls col-md-5">
                          <input type="text" class="form-control" name="weblink" ng-model="weblink" ng-keyup="formenter($event)"/>                        
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="caddress">Contact :</label>
                      <div class="controls col-md-5">
                          <textarea class="form-control" name="caddress" ng-model="caddress"></textarea>
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label class="control-label col-md-5" for="description">Description :</label>
                      <div class="controls col-md-5">
                          <textarea class="form-control" name="description" ng-model="description"></textarea>
                      </div>
                  </div>

                </fieldset>
            </form>
        </div>
         <div class="modal-footer">
            <button class="btn btn-default cancel" ng-click="closedialog()"><i class="fa fa-times"></i> Cancel</button>                          
            <button ng-click="addevent()" ng-disabled="dataForm.$invalid" class="btn btn-default"><i class="fa fa-check i-save"></i> {{btnprocess}}</button>       
        </div>
    </script>
    <!-- End of Event Dialog -->