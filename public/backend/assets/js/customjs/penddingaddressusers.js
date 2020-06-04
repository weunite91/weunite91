var Penddingaddressusers = function () {
    
    var allUserList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#pending_address-datatable',
             'ajaxURL': baseurl + "pendding-address-ajaxAction",
             'ajaxAction': 'get-pendding-address-user-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 4,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
    
    return {
        init: function () {
            allUserList();
        },
    }
}();