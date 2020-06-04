var User = function () {
    
    var allinactiveUserList = function(){
       
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#inactive-datatable',
             'ajaxURL': baseurl + "inactive-request-ajaxAction",
             'ajaxAction': 'inactive-datatable',
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
            allinactiveUserList();
        },
       
       
    }
}();