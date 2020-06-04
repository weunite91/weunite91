var ActiveUser = function() {

    var allUserList = function() {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#all-datatable',
            'ajaxURL': baseurl + "activeuser-ajaxAction",
            'ajaxAction': 'get-alluser-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    var fundraiserList = function() {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#fund-raiser-datatable',
            'ajaxURL': baseurl + "active-fund-user-ajaxAction",
            'ajaxAction': 'get-fundraiser-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    var investorList = function() {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#investor-datatable',
            'ajaxURL': baseurl + "active-investor-user-ajaxAction",
            'ajaxAction': 'get-investor-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    var partnerList = function() {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#partner-datatable',
            'ajaxURL': baseurl + "active-partner-user-ajaxAction",
            'ajaxAction': 'get-partner-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    var franchiseList = function() {

        var dataArr = {};
        var columnWidth = {};
        var arrList = {
            'tableID': '#franchise-datatable',
            'ajaxURL': baseurl + "active-franchise-user-ajaxAction",
            'ajaxAction': 'get-franchise-datatable',
            'postData': dataArr,
            'hideColumnList': [],
            'defaultSortColumn': 5,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);
    }
    var addusernote = function() {
        var form = $('#addusernotform');
        var rules = {
            usertype: { required: true },
            profile_code: { required: true },
            firstname: { required: true, minlength: 3 },
            lastname: { required: true, minlength: 3 },
            usernote: { required: true },
        };

        var messages = {
            firstname: {
                required: "Please enter Firstname",
                minlength: "At least 3 characters long"
            },
            lastname: {
                required: "Please enter Lastname",
                minlength: "At least 3 characters long",
            },
            usertype: {
                required: "Please enter User Type"
            },
            profile_code: {
                required: "Please enter your Number",
            },
            usernote: {
                required: "Please enter your Note",
            },
        }
        handleFormValidateWithMsg(form, rules, messages, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }



    return {
        init: function() {
            allUserList();
        },
        fundraiser: function() {
            fundraiserList();
        },
        investor: function() {
            investorList();
        },
        partner: function() {
            partnerList();
        },
        franchise: function() {
            franchiseList();
        },
        init: function() {
            allUserList();
        },
        addnote: function() {
            addusernote();
        },
    }
}();