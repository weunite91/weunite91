var Franchise = function () {
    
    var FranchiseList = function(){
       
        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#franchise-datatable',
            'ajaxURL': baseurl + "user-ajaxAction",
            'ajaxAction': 'get-franchise-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn':5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    return {
        init: function () {
            FranchiseList();
        },
       
    }
}();