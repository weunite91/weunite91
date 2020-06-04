var Emailverify = function () {

    var list = function () {
        var dataArr = {};
        var columnWidth = {};

         var arrList = {
             'tableID': '#email-datatable',
             'ajaxURL': baseurl + "email-verify-ajaxAction",
             'ajaxAction': 'get-email-datatable',
             'postData': dataArr,
             'hideColumnList': [],
             'defaultSortColumn': 5,
             'defaultSortOrder': 'desc',
             'setColumnWidth': columnWidth
         };
         getDataTable(arrList);
    }
  
    return{
        init: function () {
            list();
        },
        add: function () {
            addstaff();
        },
        edit: function () {
            editstaff();
        },
    }
}();