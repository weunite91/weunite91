var Fundraiser_pending = function () {
    
    var allUserList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#fr-Pending-datatable',
             'ajaxURL': baseurl + "pending-ajaxAction",
             'ajaxAction': 'get-fr-pendinguser-datatable',
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