var Investor_pending = function () {
    
    var allUserList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#i-Pending-datatable',
             'ajaxURL': baseurl + "pending-ajaxAction",
             'ajaxAction': 'get-i-pendinguser-datatable',
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
            allUserList();
        },
    }
}();