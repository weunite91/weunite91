var Investor = function () {
    
    var InvestorList = function(){
       
        var dataArr = {};
        var columnWidth = {};

        var arrList = {
            'tableID': '#investor-datatable',
            'ajaxURL': baseurl + "user-ajaxAction",
            'ajaxAction': 'get-investor-datatable',
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
            InvestorList();
        },
       
    }
}();