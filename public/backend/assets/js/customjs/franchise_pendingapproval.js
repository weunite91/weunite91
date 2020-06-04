var Franchise_pending = function () {
    
    var franchiseList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#f-Pending-datatable',
             'ajaxURL': baseurl + "pending-ajaxAction",
             'ajaxAction': 'get-f-pendinguser-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 5,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
    return {
        init: function () {
            franchiseList();
        },
    }
}();